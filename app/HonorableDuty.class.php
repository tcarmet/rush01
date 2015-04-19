<?PHP
class HonorableDuty extends Ship {
	public function __construct(array $pos) {
		$this->_posX = $pos['x'];
		$this->_posY = $pos['y'];
		if (array_key_exists("sY", $pos))
			$this->_sizeY = $pos['sY'];
		else
			$this->_sizeY = 2;
		if (array_key_exists("sX", $pos))
			$this->_sizeX = $pos['sX'];
		else
			$this->_sizeX = 7;
		parent::__construct($pos);
		$this->_name = 'Honorable Duty';
		$this->_life = 5;
		$this->_pp = 10;
		$this->_speed = 10;
		$this->_maniability = 4;
		$this->_shield = 0;
	}
}
?>
