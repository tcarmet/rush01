<?PHP

class Ship extends IShip {
	private $_name;
	private $_sprite;
	private $_maxlife;
	private $_life;
	private $_pp;
	private $_maniabilty;
	private $_weapon;
	private $_dir;
	protected $_speed;
	protected $_shield;
	protected $_sizeX;
	protected $_sizeY;
	protected $_posX;
	protected $_posY;
	protected $_array;

	use Doc;

	public function getLife() { return ($this->_life);}
	public function getPosX() { return ($this->_posX);}
	public function getPosY() { return ($this->_posY);}
	public function getSizeX() { return ($this->_sizeX);}
	public function getSizeY() { return ($this->_sizeY);}
	public function getArray() {return ($this->_array);}
	public function setPosXY($x, $y) {$this->_posX = $x; $this->_posY = $y;}
	public function setShield($pp) {
		if ($this->_pp - $pp < 0)
			return (FALSE);
		$this->_shield += $pp;
		return (TRUE);
	}

	public function setSpeed($pp) {
		if ($this->_pp - $pp < 0)
			return (FALSE);
		$this->_speed += $pp;
		return (TRUE);
	}

	// Genere un tableau _array avec les positions de tous les pixels du vaisseau
	public function __construct(array $pos) {
		$x = 0;
		for ($i = $this->getPosY(); $i < $this->getPosY() + $this->getSizeY(); $i++) {
			for ($j = $this->getPosX(); $j < $this->getPosX() + $this->getSizeX(); $j++) {
				$this->_array[$x]['x'] = $j; $this->_array[$x]['y'] = $i;
				$x++;
			}
		}
	}
	public function repair(Dice $dice) {
		if ($_pp <= 0)
			return (FALSE);
		$ret = $dice->throw();
		if ($ret == 6)
		{
			$this->_life += 1;
			if ($this->_life > $this->_maxlife)
				$this->_life = $this->_maxlife;
		}
	}

	public function rotate() {
		$x = 0;
		for ($i = $this->getPosY(); $i < $this->getPosY() + $this->getSizeX(); $i++) {
			for ($j = $this->getPosX(); $j < $this->getPosX() + $this->getSizeY(); $j++) {
				$this->_array[$x]['x'] = $j; $this->_array[$x]['y'] = $i;
				$x++;
			}
		}
	}

	// Retourne un tableau avec les cases ou l'on peut se deplacer
	public function find_movement_range() {

	}
}
?>
