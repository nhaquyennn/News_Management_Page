<?php
class Form
{   
    public static function input($type, $name, $value = '')
    {
        $xhtml = sprintf('<input class="form-control" type="%s" name="%s" value="%s">', $type, $name, $value);

        return $xhtml;
    }

    public static function label($text)
    {
        $xhtml = sprintf('<label class="font-weight-bold">%s</label>', $text);

        return $xhtml;
    }

    public static function selectBox($arrOptions, $name, $keySelected)
    {
        $xhtmlOptions = '';
        foreach ($arrOptions as $value => $text) {
            $selected = $keySelected == $value ? 'selected' : '';
            $xhtmlOptions .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $text);
        }

        $xhtml = sprintf('
        <select class="custom-select" name="%s">
            %s
        </select>
        ', $name, $xhtmlOptions);

        return $xhtml;
    }

    public static function formRow($label, $element)
    {
        $xhtml = sprintf('
        <div class="form-group">
            %s
            %s
        </div>
        ', $label, $element);

        return $xhtml;
    }
}
