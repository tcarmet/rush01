<?PHP
trait Doc {
	public static function doc() {
		return (file_get_contents(dirname(__FILE__) . '/' . __CLASS__ . 'doc.txt') . PHP_EOL);
	}
}
?>
