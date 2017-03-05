const elForm       = document.querySelector('.calculator--form');

// all relevant sections
const FormAmount   = elForm.querySelector('.form--amount');
const FormProfile  = elForm.querySelector('.form--profile');
const FormOutput   = elForm.querySelector('.form--output');

// other constants
const Profiles     = FormProfile.querySelectorAll('input');
const RangeSlider  = FormAmount.querySelector('input[name="amount"]');
const SubmitButton = elForm.querySelector('input[type="submit"]');

// pre-set amount to starting amount for quicker calculation
let Amount         = FormAmount.querySelector('input').value;

// get the variables
let profileInput = elForm.querySelector('.form--profile input:checked');
const amountInput  = elForm.querySelector('.form--amount input');

// change form to using javascript
elForm.action      = 'javascript:;';

// know js is enabled
elForm.classList.add('js-enabled');

// Add submit handler
elForm.onsubmit = function() {
  Calculate(this);
};

// remove submit button
SubmitButton.outerHTML = '';
FormAmount.querySelector('label').outerHTML = '<span class="left">&euro;15.000</span><span class="right">&euro;1.000.000</span>';

// change input amount from number to a range slider
RangeSlider.type = 'range';
RangeSlider.setAttribute('aria-valuemin', 15000);
RangeSlider.setAttribute('aria-valuemax', 1000000);
RangeSlider.setAttribute('aria-valuenow', RangeSlider.value);

// add realtime feedback to range slider
// Create output element and asign attr's
const outputBox = document.createElement('output');
const outputBoxNumber = document.createElement('span');
outputBox.setAttribute('for', 'amount');
outputBox.id = 'amount';
outputBox.innerHTML = '€';

outputBoxNumber.id = 'output-number';
outputBoxNumber.innerHTML = NumberWithSeperators(RangeSlider.value);
outputBox.appendChild(outputBoxNumber);
FormAmount.appendChild(outputBox);

// add event listener
RangeSlider.oninput = function() {
  UpdateOutput(this.value);
};

// remove hidden class if using javascript
FormOutput.classList.remove('hide');

function changeHandler() {
  // first remove all coloring classes
	for (let i = 0; i < Profiles.length; i++) {
		let Color = Profiles[i].value;
		let CurrentWrapper = Profiles[i].nextElementSibling.firstElementChild;
		CurrentWrapper.classList.remove('bg-' + Color);
		CurrentWrapper.firstElementChild.classList.remove('bg-' + Color + '--underline');
	}

	// add coloring class to selected profile
	let SelectedProfile = FormProfile.querySelector('input:checked');

	// check if profile is selected
	if ( SelectedProfile != null ) {
		// check if warnings has been displayed
		let PreviousWarning = elForm.querySelector('p.warning');
		// remove this warning (if any)
		if ( PreviousWarning != null ) {
			PreviousWarning.outerHTML = '';
		}

		// variables
		let Profile = SelectedProfile.value;
		let Wrapper = SelectedProfile.nextElementSibling.firstElementChild;
		// add proper classes to the selected profile
		Wrapper.classList.add('bg-' + Profile);
		Wrapper.firstElementChild.classList.add('bg-' + Profile + '--underline');

		// check for given amount
		Amount = FormAmount.querySelector('input').value;

		// alert when amount is zero
		if ( Amount === 0 ) {
			// create warning element
			let Warning = document.createElement('p');
			Warning.className = 'warning';
			Warning.innerHTML = 'Het inlegbedrag dient hoger dan &euro;0 te zijn.';
			// insert warning element
			elForm.insertBefore(Warning, FormOutput);
		}
		// calculate costs
		else {
			GetCosts( Profile, Amount );
		}
	}
	// show warning if no profile is selected
	else {
		// check if warning is already displayed
		let PreviousWarning = elForm.querySelector('p.warning');
		if ( PreviousWarning == null ) {
			// create warning element
			let Warning = document.createElement('p');
			Warning.className = 'warning';
			Warning.innerHTML = 'Selecteer eerst een beleggingsprofiel.';
			// insert warning element
			elForm.insertBefore(Warning, FormOutput);
		}
	}
}

// add eventlistener to complete form #bubblingbubbling
elForm.addEventListener('change', changeHandler);

function UpdateOutput(amount) {
	let AmountOutput = document.querySelector('#amount');
	AmountOutput.value = '€' + NumberWithSeperators(amount);
	// fix position TODO finetuning
	let StyleLeft = ((amount/1000000)*100) -6;
	if( StyleLeft < 0 ) {
		StyleLeft = -1;
	}
  if (StyleLeft > 80) {
    AmountOutput.style.left = (StyleLeft - 8) + '%';
  } else {
    AmountOutput.style.left = StyleLeft + '%';
  }
}

function NumberWithSeperators(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function GetCosts(Profile, Amount) {
	let CalcURL = window.location.protocol + '//' + window.location.host + '/?control=Calculator&profile=' + Profile + '&amount=' + Amount;

	AjaxCall(CalcURL, function( Response) {
		elForm.querySelector('.percentage').innerHTML = Number(Response.percentage).toFixed(2).replace('.', ',') + '%';
		elForm.querySelector('.cost').innerHTML = '&euro;' + NumberWithSeperators(Number(Response.costs).toFixed(0).replace('.', ','));

	});
}

function Calculate(form) {
	// calculate the numbers
  profileInput = elForm.querySelector('.form--profile input:checked');
	GetCosts(profileInput.value, amountInput.value);
}

function AjaxCall( url, fnCallback ) {
	let request = makeHttpObject();
	request.open( 'GET', url, true );
	request.send( null );
	request.onreadystatechange = function() {
		if ( request.readyState === XMLHttpRequest.DONE && request.status === 200 ) {
			let response = JSON.parse(request.responseText);

			// error handling
			if (typeof response.error !== 'undefined' && response.error === true) {
				alert(response.message);
				return;
			}
			// no error: call callback
			else if (typeof fnCallback === 'function') {
				fnCallback(response);
			}
		}
	};

	function makeHttpObject() {
		try { return new XMLHttpRequest(); }
		catch (error) {}
		try { return new ActiveXObject('Msxml2.XMLHTTP'); }
		catch (error) {}
		try { return new ActiveXObject('Microsoft.XMLHTTP'); }
		catch (error) {}

		throw new Error('Could not create HTTP request object.');
	}
}
