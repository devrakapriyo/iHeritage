<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class visitor_counting extends Model
{
    protected $table = 'visitor_counting';

    public static function simpan($institutional_id, $ip, $view, $url)
    {
        $visitor = self::where('ip', $ip)->where('url', $url)->whereDate('created_at', date("Y-m-d"))->first();
        if(empty($visitor))
        {
            $simpan = new visitor_counting;
            $simpan->institutional_id = $institutional_id;
            $simpan->ip = $ip;
            $simpan->view = $view;
            $simpan->url = $url;
            $simpan->save();

            return $simpan;
        }
    }

    public static function visitorLineChartFeb($institutional_id)
    {
        $query = self::select(
            DB::raw("date(created_at) as date"),
            DB::raw("COUNT(id) as visit")
        )
            ->whereMonth('created_at', "02")
            ->orderBy("created_at")
            ->groupBy(DB::raw("date(created_at)"));

        $query->when($institutional_id != "all", function ($q) use ($institutional_id) {
            return $q->where('institutional_id', $institutional_id);
        });

        $visitor = $query->get();

        $result[] = ['Date','Visitor '];
        foreach ($visitor as $key => $value) {
            $result[++$key] = [$value->date, (int)$value->visit];
        }

        return json_encode($result);
    }

    public static function visitorLineChartMar($institutional_id)
    {
        $query = self::select(
            DB::raw("date(created_at) as date"),
            DB::raw("COUNT(id) as visit")
        )
            ->whereMonth('created_at', "03")
            ->orderBy("created_at")
            ->groupBy(DB::raw("date(created_at)"));

        $query->when($institutional_id != "all", function ($q) use ($institutional_id) {
            return $q->where('institutional_id', $institutional_id);
        });

        $visitor = $query->get();

        $result[] = ['Date','Visitor '];
        foreach ($visitor as $key => $value) {
            $result[++$key] = [$value->date, (int)$value->visit];
        }

        return json_encode($result);
    }

    public static function visitorLineChart($institutional_id)
    {
        $query = self::select(
            DB::raw("date(created_at) as date"),
            DB::raw("COUNT(id) as visit")
        )
            ->whereMonth('created_at', date("m"))
            ->orderBy("created_at")
            ->groupBy(DB::raw("date(created_at)"));

        $query->when($institutional_id != "all", function ($q) use ($institutional_id) {
            return $q->where('institutional_id', $institutional_id);
        });

        $visitor = $query->get();

        $result[] = ['Date','Visitor '];
        foreach ($visitor as $key => $value) {
            $result[++$key] = [$value->date, (int)$value->visit];
        }

        return json_encode($result);
    }

    public static function visitorLineChartFilter($institutional_id, $from, $to)
    {
        $query = self::select(
            DB::raw("date(created_at) as date"),
            DB::raw("COUNT(id) as visit")
        )
            ->whereBetween('created_at', [$from, $to])
            ->orderBy("created_at")
            ->groupBy(DB::raw("date(created_at)"));

        $query->when($institutional_id != "all", function ($q) use ($institutional_id) {
            return $q->where('institutional_id', $institutional_id);
        });

        $visitor = $query->get();

        $result[] = ['Date','Visitor '];
        foreach ($visitor as $key => $value) {
            $result[++$key] = [$value->date, (int)$value->visit];
        }

        return json_encode($result);
    }

    public static function viewPieChart($institutional_id, $view)
    {
        $query = self::select('view');

        $query->when($institutional_id != "all", function ($q) use ($institutional_id) {
            return $q->where('institutional_id', $institutional_id);
        });

        return $query->where('view', $view)->count();
        $all = $query->count();
        $view = $query->where('view', $view)->count();
        return ($all * $view)/100;
    }

    public static function visitor_perday($institutional_id)
    {
        $query = self::select('id');

        $query->when($institutional_id != "all", function ($q) use ($institutional_id) {
            return $q->where('institutional_id', $institutional_id);
        });

        return $query->whereDate('created_at', date("Y-m-d"))->count();
    }
}
