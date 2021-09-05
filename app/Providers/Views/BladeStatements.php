<?php

namespace App\Providers\Views;

use Blade;

trait BladeStatements
{

    public function bootBladeStatements()
    {
        $this->bootDirectiveDate();
        $this->bootDirectiveTemperature();
    }

    /**
     * @param null $format
     *
     * @date($date, 'd.m.Y')
     */
    private function bootDirectiveDate($format = null)
    {
        Blade::directive('date', function ($expression) use ($format) {
            $format = $format ?: 'd.m.Y';
            return "<?php echo ($expression)->format('$format'); ?>";
        });
    }

    /**
     * @temperature($value)
     */
    private function bootDirectiveTemperature()
    {
        Blade::directive('temperature', function ($expression) {
            return "<?php echo ($expression . ' &#8451;' ); ?>";
        });
    }


}