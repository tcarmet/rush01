<?PHP
class Dice {
	public function throw_dice($nbdice) {
		for ($i = 0; $i < $nbdice; $i++) {
			$ret_array[] = mt_rand(1, 6);
		}
		return ($ret_array);
	}
}
?>
