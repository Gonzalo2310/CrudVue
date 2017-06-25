<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Departure;
use App\Position;
class Employee extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'birthday',
        'position_id'
    ];
    protected $appends = ['years','departure'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Position');
    }
    public function getBirthdayAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    public function getYearsAttribute()
    {
        $hoy = Carbon::now();
        $fecha = Carbon::parse($this->birthday);
        return $fecha->diffInYears($hoy);
    }
    public function getDepartureAttribute(){
        $departure=Departure::find(Position::find($this->position_id)->departure_id);
        return [
            'title'=>$departure->title,
            'id'=>$departure->id
        ];
    }
}
