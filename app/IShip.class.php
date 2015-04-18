<?PHP
abstract class IShip {
	private $_name;
	private $_size;
	private $_sprite;
	private $_life;
	private $_pp;
	private $_speed;
	private $_maniabilty;
	private $_shield;
	private $_weapon;
	private $_pos;

	abstract public function getPosX();
	abstract public function getPosY();
	abstract public function getSizeX();
	abstract public function getSizeY();
	abstract public function setPosXY($x, $y);
	abstract public function getArray();
}
?>
