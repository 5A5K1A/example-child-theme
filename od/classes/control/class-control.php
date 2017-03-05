<?php
class Control {

	public function ErrorObject( $message ) {
		$oResponse 			= new StdClass();
		$oResponse->error 	= TRUE;
		$oResponse->message = $message;

		$this->OutputJSON($oResponse);
	}

	public function OutputJSON( $object ) {
		echo json_encode( $object );
		exit;
	}

	public function ConvertXmlToArray( $xmlstring ) {
		$xml 	= simplexml_load_string( $xmlstring );
		$json 	= json_encode( $xml );
		$array 	= json_decode( $json, TRUE );

		return $array;
	}
}