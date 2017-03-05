// data used in PHP
const data = TableData;

const dataArr = [];
// Options settings for the chart
const options = {
  tooltip: { // remove tooltip on hover
    trigger: 'none'
  },
  hAxis: { // style the bottom labels
    textStyle: {
      fontName: false,
      color: '#57AB27',
      fontSize: 18
    }
  },
  vAxis: { // remove the left bar
    baseline: 0,
    baselineColor: '#132862',
    gridlineColor: '#fff',
    textPosition: 'none'
  }, // settings of the chart inside the graph
  chartArea: {
    height: '60%', // percents should be strings
    width: '95%' // pixel dimensions should be numbers
  },
  width: 720,
  height: 320, // dimentions of the graph
  legend: { position: 'none' }, // hide legend
  bar: {groupWidth: '85%'}, // Set all bar eaqle width
  animation: { // add an animation onload
    duration: 1000,
    easing: 'out',
    startup: true
  }
};





// loop thrue all keys in the data object
for (var key in data) {
  if (data.hasOwnProperty(key)) {
    // store the value
    const values = data[key];
    const year = key;

    // create an array for eacht chart that needs to be generated
    let chart = [[year, year, { role: 'style' } ]];

    // loop thrue all the keys in the object
    for (var key in values) {

      // create an array for each row in the chart
      const row = [];

      // make the numbers a string with only two decimals AND replace points with comma's
      const amount = Number(values[key]).toFixed(2);
      const newAmount = amount.replace('.', ',');

      // push all elements needed into the row
      row.push(newAmount + '%');
      row.push(Number(values[key]));
      const color = getColor(key);
      row.push(color);

      // push each row into the chart
      chart.push(row);
    }

    // push the cart to the array needed for Google Graphs
    dataArr.push(year);
    dataArr.push(chart);
  }
}

// Generate the right color hash
function getColor(string) {
  if (string === 'rood') {
    return '#FFCDD2';
  } else if (string === 'oranje') {
    return '#FFE0B2';
  } else if (string === 'geel') {
    return '#FFF9C4';
  } else if (string === 'groen') {
    return '#D1F1BE';
  } else {
    return '#E0F7FA';
  }
}

// Render the Google chart
google.charts.load('current', {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  let titleContent;

  // Make a chart for each item in the array
  for (var i = 0; i < dataArr.length; i++) {
    // store the item
    const item = dataArr[i];

    // if the item is an sting, it's the new year
    if (typeof item === 'string') {
      titleContent = item;
    } else {
      // regenerate array to Googles data table
      const data = google.visualization.arrayToDataTable(item);
      const view = new google.visualization.DataView(data);

      // Columns settings
      view.setColumns([0, 1, 2,]);

      // Get element in HTML
      const chartElement = document.querySelector('.google-chart');

      // Create new element to attatch the chart
      const el = document.createElement('div');
      el.classList.add('google-chart--chart');

      // Create the custom title
      const titleContainer = document.createElement('div');
      const title = document.createElement('p');
      title.classList.add('google-chart--title');
      titleContainer.classList.add('google-chart--title-container');
      title.innerHTML = titleContent;
      titleContainer.appendChild(title);

      // Attatch Google chart
      const chart = new google.visualization.ColumnChart(el);

      // Render chart
      chart.draw(view, options);

      // insert the title to the chart
      el.insertBefore(titleContainer, el.childNodes[0]);
      // reattatch to HTML
      chartElement.appendChild(el);
    }
  }

  document.querySelector('.chartify').classList.add('hide');
}
