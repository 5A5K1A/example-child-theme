<?php
/**
 * Class to calculate the costs
 */
class Control_Calculator extends Control {

	/**
	 * Required variables
	 */
	private $iBasePercentage;
	private $iProfilePercentages;

	private $sProfile;
	private $iAmount;

	private $iCosts;
	private $iPercentage;

	public function __construct() {

		$sProfile = strtolower( GetValue('profile') );
		$iAmount  = GetValue('amount');

		// early exit if no amount is provided
		if( !$sProfile || !in_array($sProfile, array('rood', 'oranje', 'geel', 'groen', 'blauw')) ) {
			return $this->ErrorObject('Maak een keuze uit de profielen.'); exit;
		}

		// early exit if no amount is provided
		if( !$iAmount || $iAmount === 0 ) {
			return $this->ErrorObject('Het inlegbedrag dient hoger dan 0 te zijn.'); exit;
		}

		$this->sProfile = $sProfile;
		$this->iAmount  = $iAmount;

		// setup object to return
		$oResponse = new StdClass();

		// get all the provided numbers
		$this->GetCalculatorOptions();

		// fill posted values
		$oResponse->profile = $sProfile;
		$oResponse->amount  = $iAmount;

		// calculate yearly costs
		$this->CalculateNumbers( $iAmount );
		$oResponse->percentage     = $this->iPercentage;
		$oResponse->costs          = $this->iCosts;
		$oResponse->costsFormatted = number_format($this->iCosts, 2, ',', '.' );

		// return
		$this->OutputJSON($oResponse);
	}

	/**
	 * Calculates the numbers.
	 * @param      integer 	$iAmount 	The amount
	 * @param      string 	$sProfile 	The profile color
	 */
	private function CalculateNumbers( $iAmount, $sProfile = NULL ) {
		if( !$sProfile ) { $sProfile = $this->sProfile; }

		$this->iPercentage = $this->CalculatePercentage( $iAmount );
		$this->iCosts      = $this->CalculateCosts( $iAmount );
	}

	/**
	 * Calculates the yearly percentage.
	 * @param      integer 	$iAmount 	The amount
	 * @param      string 	$sProfile 	The profile color
	 */
	private function CalculatePercentage( $iAmount, $sProfile = NULL ) {
		if( !$sProfile ) { $sProfile = $this->sProfile; }

		$iPercentage       = (( $this->iBasePercentage + ($this->iProfilePercentages[$this->sProfile] * $iAmount) ) / $iAmount ) * 100;
		return round( $iPercentage, 4 );
	}

	/**
	 * Calculates the yearly costs.
	 * @param      integer 	$iAmount 	The amount
	 */
	private function CalculateCosts( $iAmount ) {
		return round(($this->iPercentage * $iAmount/100), 2);
	}

	/**
	 * Gets the calculator options from WordPress
	 */
	private function GetCalculatorOptions() {
		//
		$this->iBasePercentage     = get_field('calc_base_perc', 'options');
		$this->iProfilePercentages = array(
			'rood'   => get_field('calc_rood_perc', 'options'),
			'oranje' => get_field('calc_oranje_perc', 'options'),
			'geel'   => get_field('calc_geel_perc', 'options'),
			'groen'  => get_field('calc_groen_perc', 'options'),
			'blauw'  => get_field('calc_blauw_perc', 'options')
		);
	}
}
