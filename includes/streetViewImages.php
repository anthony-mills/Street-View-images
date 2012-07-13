<?php
/**
 * 
 * PHP Wrapper class to retrieve images using the Street View Image API
 * 
 * @author Anthony Mills <me@anthony-mills.com>
 * @copyright 2012 Anthony Mills
 * @link http://www.development-cycle.com
 */
 class streetViewImages
 {
 	protected $_apiKey = '';
	protected $_apiLocation = 'http://maps.googleapis.com/maps/api/streetview';
	protected $_apiPosition = '151.193689387, -33.8690565931';
	protected $_imageSize = '500x500'; 
	protected $_locationSensor = 'FALSE';
	protected $_cameraHeading = 0;
	protected $_cameraPitch = 0;
	protected $_imageFov = 90;
	
	public function __construct($apiKey = NULL)
	{
		if (!empty($apiKey)) {
			$this->_apiKey = $apiKey;
		}	
	}
	
	/**
	 * 
	 * Set the size of the image view image you would like returned (the maximum possible dimensions are 640 x 640)
	 * 
	 * @param integer $horizontalSize
	 * @param integer $verticalSize
	 * 
	 * @return boolean
	 */
	public function setImageSize($horizontalSize, $verticalSize)
	{
		if (((is_numeric($horizontalSize)) && ($horizontalSize <= 640)  && ($horizontalSize > 0)) && ((is_numeric($verticalSize))) && ($verticalSize <= 640)  && ($verticalSize > 0))
		{
			$this->_imageSize = $horizontalSize . 'x' . $verticalSize;
			
			return TRUE;
		} 	
	}
	
	/**
	 * 
	 * Set camera heading for the image in degrees ( input is number between 0 - 360 )
	 * 
	 * @param integer $cameraDegrees
	 * 
	 * @return boolean
	 */
	public function setCameraHeading($cameraDegrees)
	{
		if ((!empty($cameraDegrees)) && ($cameraDegrees >= 0) && ($cameraDegrees <= 360 )) {
			$this->_cameraHeading = $cameraDegrees;
			
			return TRUE;		
		}
	}
	
	/**
	 * 
	 * Set the pitch of the angle in degrees default is 0 and level, max is 90 degrees which is straight up
	 * 
	 * @param integer $cameraPitch
	 * 
	 * @return boolean
	 */
	 public function setCameraPitch($cameraPitch)
	 {
	 	if ((is_nemeric($cameraPitch)) && ($cameraPitch > 0) && ($cameraPitch < 90))
		{
			$this->_cameraPitch = $cameraPitch;
			
			return TRUE;
		}  
	 }
	 
	/** 
	 * 
	 * Set the camera "field of view" in degrees (Input is number between 1 - 120 )
	 * Default FOV is 90 degrees
	 * 
	 * @param integer $imageFov
	 * 
	 * @return boolean
	 */
	public function setImageFov($imageFov)
	{
		if ((!empty($imageFov)) && ($imageFov = 0) && ($imageFov <= 120 )) {
			$this->_imageFov = $imageFov;
			
			return TRUE;		
		}		
	}
	
	/**
	 * 
	 * Tell google if the GPS co-ordinates were provided by a GPS device AKA mobile phone or similar
	 * 
	 * @param boolean $gpsSensor
	 * 
	 * @return boolean 
	 */
	 public function setSensor($gpsSensor = FALSE)
	 {
	 	if (!gpsSensor) {
	 		$this->_locationSensor = 'FALSE';
	 	} else {
	 		$this->_locationSensor = 'TRUE';
			return TRUE;			
	 	}
		
	 }
	
	/**
	 * 
	 * Build a request and retrive images from the Google Street View Images API
	 * 
	 * @return string $imageResult
	 */
	public function getImage($imageLocation)
	{
		if (!empty($imageLocation)) {
			$this->_apiPosition = $imageLocation;
		}
		 
		$requestString = '?size=' . $this->_imageSize . '&location=' . $this->_apiPosition . '&sensor=' . strtolower($this->_locationSensor) .
							'&heading=' . $this->_cameraHeading . '&cameraPitch=' . $this->_cameraPitch . '&fov=' . $this->_imageFov;
							
		if (!empty($this->_apiKey)) {
			 $requestString = $requestString . '&key=' . $this->_apiKey;
		}
		
		$requestString = $this->_apiLocation . ($requestString);
		
		return $requestString;
	}
}
