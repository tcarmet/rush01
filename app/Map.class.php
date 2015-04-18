<?PHP
// $this->_matrix[Y][X]
// 				100 150
class Map {
	const WIDTH = 150;
	const HEIGHT = 100;
	const NB_OBSTACLE = 10;
	const OBSTACLE = 1;
	const SHIP = 2;
	private $_matrix = array();

	use Doc;

	public function getMapXY($x, $y) {
		return ($this->_matrix[$y][$x]);
	}

	public function setMapXY($x, $y, $val) {
		if ($x >= self::WIDTH || $y >= self::HEIGHT)
			return (FALSE);
		$this->_matrix[$y][$x] = $val;
		return (TRUE);
	}

	private function init_matrix() {
		$this->_matrix = array_fill(0, self::HEIGHT, 0);
		for ($i = 0; $i < self::WIDTH ; $i++) {
			$this->_matrix[$i] = array_fill(0, self::WIDTH, 0);
		}
	}

	private function put_object($posX, $posY, $height, $width, $type) {
		$val = ($type == 'ship') ? 2 : 1;
		for ($i = 0; $i < $height; $i++) {
			for ($j = 0; $j < $width; $j++) {
				$this->_matrix[$posY + $i][$posX + $j] = $val;
			}
		}
	}

	public function __construct(array $data) {
		self::init_matrix();
		for ($i = 0; isset($data[$i]); $i++) {
			self::put_object($data[$i]['position_x'], $data[$i]['position_y'], $data[$i]['width'], $data[$i]['lenght'], $data[$i]['type_object']);
		}
	}
}
?>
