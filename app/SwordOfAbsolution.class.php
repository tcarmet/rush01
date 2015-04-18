<?PHP
class SwordOfAbsolution extends Ship {
	public function __construct(array $pos) {
		$this->_posX = $pos['x'];
		$this->_posY = $pos['y'];
		parent::__construct($pos);
		$this->_name = 'Honorable Duty';
		$this->_sizeY = 1;
		$this->_sizeX = 3;
		$this->_maxlife = $this->_life = 4;
		$this->_pp = 10;
		$this->_speed = 18;
		$this->_maniability = 3;
		$this->_shield = 0;
	}
}
?>
