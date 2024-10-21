<?php
class Helper
{
    public static function showItemStatus($id, $status)
    {
        $icon = 'fa-check';
        $color = 'btn-success';

        if ($status == 'inactive') {
            $icon = 'fa-minus';
            $color = 'btn-danger';
        }

        $xhtml = sprintf('<a href="change-status.php?id=%s&status=%s" class="btn btn-sm %s"><i class="fas %s"></i></a>', $id, $status, $color, $icon);

        return $xhtml;
    }

    public static function highlight($search, $value)
    {
        if ($search != '') {
            return preg_replace('/' . preg_quote($search, '/') . '/ui', '<mark>$0</mark>', $value);
        }

        return $value;
    }
}
