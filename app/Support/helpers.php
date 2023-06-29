<?php

use App\Support\Constants;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

function only_letters_and_space($string)
{
    return preg_replace('/([^a-zA-Z\s])/', '', $string);
}

function startTimer()
{
    Timer::$starttime = microtime(true);
}

function endTimer()
{
    Timer::$endtime = microtime(true);

    return Timer::$endtime - Timer::$starttime;
}

if (!function_exists('studly')) {
    /**
     * Convert a value to studly caps case.
     *
     * @param  string $value
     * @return string
     */
    function studly($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }
}

function toBoolean($boolean)
{
    return $boolean === 'true' || $boolean === '1' || $boolean === 1 || $boolean === true;
}

function only_numbers($string)
{
    return preg_replace('/\D/', '', $string);
}

function remove_punctuation($string)
{
    return preg_replace('/[^a-z0-9]+/i', '', $string);
}

function ld($info)
{
    info($info);
    die();
}

function make_pdf_filename($baseName)
{
    return Str::slug($baseName . ' ' . now()->format('Y m d H i')) . '.pdf';
}

function make_filename($baseName, $extension)
{
    return Str::slug($baseName . ' ' . now()->format('Y m d H i')) . '.' . $extension;
}

function current_user()
{
    return auth()->user();
}

function unnacent($string)
{
    $table = [
        'Š' => 'S',
        'š' => 's',
        'Đ' => 'Dj',
        'đ' => 'dj',
        'Ž' => 'Z',
        'ž' => 'z',
        'Č' => 'C',
        'č' => 'c',
        'Ć' => 'C',
        'ć' => 'c',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Å' => 'A',
        'Æ' => 'A',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ø' => 'O',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ý' => 'Y',
        'Þ' => 'B',
        'ß' => 'Ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'æ' => 'a',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ð' => 'o',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ø' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ý' => 'y',
        'þ' => 'b',
        'ÿ' => 'y',
        'Ŕ' => 'R',
        'ŕ' => 'r',
    ];

    return strtr($string, $table);
}

function make_slug($string)
{
    return Str::slug(unnacent($string));
}

function capitalizeBrazilian($name)
{
    $string = mb_convert_case($name, MB_CASE_TITLE);

    $string = trim(preg_replace('/\s\s+/', ' ', $string));

    coollect(['de', 'da', 'do', 'das', 'dos', 'e'])->each(function ($exception) use (&$string) {
        $exception = mb_convert_case($exception, MB_CASE_TITLE);

        $newCase = mb_convert_case($exception, MB_CASE_LOWER);

        $string = str_replace(" {$exception} ", " {$newCase} ", $string);

        preg_match_all('/(.\'.)/ui', $string, $matched);

        if (isset($matched[0])) {
            coollect($matched[0])->each(function ($match) use (&$string) {
                $newCase = mb_convert_case($match, MB_CASE_UPPER);

                $string = str_replace(substr($match, 1), substr($newCase, 1), $string);
            });
        }
    });

    return $string;
}

function permission_slug($string)
{
    $string = str_replace(':', $replace = 'xxxxxxxxxx', $string);

    return str_replace($replace, ':', Str::slug($string));
}

function to_reais($number)
{
    return 'R$ ' . number_format($number, 2, ',', '.');
}

function without_reais($number)
{
    return str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $number)));
}

function trunc_value_with_two_digits($number)
{
    return intval($number * 100) / 100;
}

function db_listen($dump = false)
{
    \DB::listen(function ($query) use ($dump) {
        \Log::info($query->sql);
        \Log::info($query->bindings);

        if ($dump) {
            dump($query->sql);
            dump($query->bindings);
        }
    });
}

function faker()
{
    return \Faker\Factory::create('pt_BR');
}

function in($needle, ...$haystack): bool
{
    foreach ($haystack as $hay) {
        if ((is_array($hay) && in($needle, ...$hay)) || $needle == $hay) {
            return true;
        }
    }

    return false;
}

function nin($needle, ...$haystack): bool
{
    return !in($needle, ...$haystack);
}

function allows($ability)
{
    if (!($can = \Illuminate\Support\Facades\Gate::allows($ability))) {
        //    if (!$can = auth()->user()->can($ability)) {
        info(
            sprintf(
                'User [%s, %s] is not permitted to do %s',
                auth()->user()->name,
                auth()->user()->email,
                collect($ability)->implode(', ')
            )
        );
    }

    return $can;
}

function make_deep_path($nameHash, $length = 4)
{
    $deepPath = '';

    for ($i = 1; $i <= $length; $i++) {
        $deepPath = $deepPath . substr($nameHash, $i - 1, 1) . DIRECTORY_SEPARATOR;
    }

    return $deepPath;
}

function formMode($mode = null)
{
    return $mode
        ? session()->flash(Constants::SESSION_FORM_MODE, $mode)
        : session(Constants::SESSION_FORM_MODE, Constants::FORM_MODE_SHOW);
}

function is_at_least_verbose($command)
{
    return $command->getOutput()->getVerbosity() >=
        \Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERBOSE;
}

function is_br_date($date)
{
    try {
        $date = Carbon::createFromFormat('d/m/Y', $date);
    } catch (\InvalidArgumentException $e) {
        //Not a date
        return false;
    }
    return true;
}

function mask_zipcode($zipcode)
{
    return preg_replace('/(\d\d\d\d\d)(\d\d\d)/', '$1-$2', $zipcode);
}

function mask_cpf($cpf)
{
    return preg_replace('/(\d\d\d).(\d\d\d).(\d\d\d)-(\d\d)/', '$1.$2.$3-$4', $cpf);
}

function login_as_system()
{
    return app(\App\Data\Repositories\Users::class)->loginAsSystem();
}

function to_sql_with_bindings($query)
{
    return vsprintf(
        str_replace('?', '%s', $query->toSql()),
        collect($query->getBindings())
            ->map(function ($binding) {
                return is_numeric($binding) ? $binding : "'{$binding}'";
            })
            ->toArray()
    );
}

class Timer
{
    public static $starttime;
    public static $endtime;
}

function validate_cpf($string)
{
    return Validator::make(
        ['string' => $string],
        [
            'string' => 'required|cpf',
        ]
    )->passes();
}

function mask_protocol_number($protocol_number)
{
    $ano = substr($protocol_number, 0, 4);
    $codigo = substr($protocol_number, 4, 4);

    return $codigo . '/' . $ano;
}

function protocol_number_masked_to_bigint($protocol_number_masked)
{
    $protocol_number = only_numbers($protocol_number_masked);

    $codigo = substr($protocol_number, 0, 4);
    $ano = substr($protocol_number, 4, 4);

    return $ano . $codigo;
}

function mount_text($txt)
{
    return substr($txt, 0, 120);
}

function mount_css_text($txt)
{
    if (strlen($txt) <= 100) {
        return 'badge-font-size-11';
    } elseif (strlen($txt) <= 110) {
        return 'badge-font-size-10';
    } else {
        return 'badge-font-size-9';
    }
}
