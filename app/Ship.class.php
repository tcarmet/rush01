<?PHP

class Ship extends IShip {
	private $_idship;
	private $_idusr;
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

	public function getID() { return ($this->_idship);}
	public function getuID() { return ($this->_idusr);}
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
		$this->_idship = $pos['id'];
		$this->_idusr = $pos['idusr'];
		// $x = 0;
		// for ($i = $this->getPosY(); $i < $this->getPosY() + $this->getSizeY(); $i++) {
		// 	for ($j = $this->getPosX(); $j < $this->getPosX() + $this->getSizeX(); $j++) {
		// 		$this->_array[$x]['x'] = $j; $this->_array[$x]['y'] = $i;
		// 		$x++;
		// 	}
		// }
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
		$tmp = $this->_sizeX;
		$this->_sizeX = $this->_sizeY;
		$this->_sizeY = $tmp;
		$this->_posX += ($this->_sizeX / 2) - ($this->_sizeY / 2) + ($this->_sizeY % 2);
		$this->_posY += ($this->_sizeY / 2) - ($this->_sizeX / 2) + ($this->_sizeX % 2);
		return ;
	}

	public function shoot(Map $map) {
		$tb = array();
		$x = $this->_posX;
		while ($x < $this->_posX + $this->_sizeY && $x < 150)
		{
			$y = $this->_posY - 1;
			while ($y >= 0)
			{
				if ($map->getMapXY($x, $y) != 0)
				{
					$tb[] = array('x' => $x, 'y' => $y);
					break ;
				}
				$y--;
			}
			$x++;
		}
		$x = $this->_posX;
		while ($x < ($this->_posX + $this->_sizeY) && $x < 150)
		{
			$y = $this->_posY + $this->_sizeX;
			while ($y < 100)
			{
				if ($map->getMapXY($x, $y) != 0)
				{
					$tb[] = array('x' => $x, 'y' => $y);
					break ;
				}
				$y++;
			}
			$x++;
		}
		$y = $this->_posY;
		while ($y < ($this->_posY + $this->_sizeX) && $y < 100)
		{
			$x = $this->_posX - 1;
			while ($x > 0)
			{
				if ($map->getMapXY($x, $y) != 0)
				{
					$tb[] = array('x' => $x, 'y' => $y);
					break ;
				}
				$x--;
			}
			$y++;
		}
		$y = $this->_posY;
		while ($y < ($this->_posY + $this->_sizeX) && $y < 100)
		{
			$x = $this->_posX + $this->_sizeY;
			while ($x < 150)
			{
				if ($map->getMapXY($x, $y) != 0)
				{
					$tb[] = array('x' => $x, 'y' => $y);
					break ;
				}
				$x++;
			}
			$y++;
		}
		return ($tb);
	}

	// Retourne un tableau avec les cases ou l'on peut se deplacer
	public function find_movement_range(Map $map) {
		$tb = array();
		$x = $this->_posX;
		while ($x < ($this->_posX + $this->_sizeY) && $x < 150)
		{
			$y = $this->_posY - 1;
			while ($y >= 0 && $y >= ($this->_posY - $this->_speed))
			{
				if ($map->getMapXY($x, $y) == 0)
					$tb[] = array('x' => $x, 'y' => $y);
				else
					break ;
				$y--;
			}
			$x++;
		}
		$x = $this->_posX;
		while ($x < ($this->_posX + $this->_sizeY) && $x < 150)
		{
			$y = $this->_posY + $this->_sizeX;
			while ($y <= ($this->_posY + $this->_sizeX + $this->_speed))
			{
				if ($map->getMapXY($x, $y) == 0)
					$tb[] = array('x' => $x, 'y' => $y);
				else
					break ;
				$y++;
			}

			$x++;
		}
		$y = $this->_posY;
		while ($y < ($this->_posY + $this->_sizeX) && $y < 100)
		{
			$x = $this->_posX - 1;
			while ($x >= 0 && $x >= ($this->_posX - $this->_speed))
			{
				if ($map->getMapXY($x, $y) == 0)
					$tb[] = array('x' => $x, 'y' => $y);
				else
					break ;
				$x--;
			}
			$y++;
		}
		$y = $this->_posY;
		while ($y < ($this->_posY + $this->_sizeX) && $y < 100)
		{
			$x = $this->_posX + $this->_sizeY;
			while ($x <= ($this->_posX + $this->_sizeY + $this->_speed) && $x < 150)
			{
				if ($map->getMapXY($x, $y) == 0)
					$tb[] = array('x' => $x, 'y' => $y);
				else
					break ;
				$x++;
			}
			$y++;
		}
		return ($tb);
	}
}
?>
