<?php
declare(strict_types=1);

function is_found($current, $target)
{
	$i = 0;

	if ($current['name'] == $target)
		return 1;
	while (isset($current['child'][$i])) {
		if ($current['child'][$i]['name'] == $target) {
			return 1;
		} elseif (is_found($current['child'][$i], $target) == 1) {
			return 1;
		}
		$i = $i + 1;
	}
	return 0;
}

class Breadcrumb
{
    private $menu;

    public function setMenu($menu)
    {
        $this->menu = $menu;
    }
	
    public function getBreadcrumb($currentPage)
    {
	$res = array();
	$i = 0;
	$temp = $this->menu;

	while (isset($temp[$i])) {
		if ($temp[$i]['name'] == $currentPage) {
			$res[] = $temp[$i]['name'];
			break;
		} elseif (is_found($temp[$i], $currentPage) == 1) {
			$res[] = $temp[$i]['name'];
			$temp = $temp[$i]['child'];
			$i = -1;
		}
		$i = $i + 1;
	}
    return $res;
    }
	
}
?>