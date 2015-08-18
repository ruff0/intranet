<?php

class BookingItem extends Illuminate\Database\Eloquent\Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_item';

    /**
     * Rules
     */
    public static $rules = array(
        'ressource_id' => 'required|exists:ressource',
        'booking_id' => 'required|exists:booking',
        'start_at' => 'date|unique_booking',
        'duration' => 'required|min:15'
    );

    /**
     * Rules Add
     */
    public static $rulesAdd = array(
        'ressource_id' => 'required|exists:ressource',
        'booking_id' => 'required|exists:booking',
        'start_at' => 'date|unique_booking',
        'duration' => 'required|min:15'
    );

    public function ressource()
    {
        return $this->belongsTo('Ressource');
    }

    public function booking()
    {
        return $this->belongsTo('Booking');
    }

    public function scopeAll($query)
    {
        return $query;
    }

    public function toJsonEvent()
    {
        if (is_object($this->start_at)) {
            $start = $this->start_at;
        } else {
            $start = new \DateTime($this->start_at);

        }
        $end = clone $start;
        $end->modify(sprintf('+%d minutes', $this->duration));

        $user = Auth::user();
        $start2 = clone $start;
        $start2->modify('-2 days');
        $canManage = $user->isSuperAdmin() ||
            (($this->booking->user_id == $user->id) && ($start2->format('Y-m-d') >= date('Y-m-d')));

        $ofuscated_title = $this->booking->title;
        if ($this->booking->is_private && !$user->isSuperAdmin() && ($this->booking->user_id != $user->id)) {
            $ofuscated_title = 'Réservé';
            $className = sprintf('booking-ofuscated-%d', $this->ressource_id);
        } else {
            $className = 'booking';
        }
        $backgroundColor = $this->ressource->booking_background_color;
        $borderColor = adjustBrightness($this->ressource->booking_background_color, -32);
        $textColor = adjustBrightness($this->ressource->booking_background_color, -128);
        if ($end->format('Y-m-d H:i:s') < date('Y-m-d H:i:s')) {
            $backgroundColor = hexColorToRgbWithTransparency($backgroundColor, '0.4');
            $borderColor = hexColorToRgbWithTransparency($borderColor, '0.4');
            $textColor = hexColorToRgbWithTransparency($textColor, '0.4');

            $className .= ' booking-completed';
        }
        return array(
            'title' => $ofuscated_title,
            'start' => $start->format('c'),
            'end' => $end->format('c'),
            'booking_id' => $this->booking->id,
            'id' => $this->id,
            'is_private' => $this->booking->is_private,
            'description' => $this->booking->content,
            'canDelete' => (bool)$canManage,
            'editable' => (bool)$canManage,
            'backgroundColor' => $backgroundColor,
            'borderColor' => $borderColor,
            'textColor' => $textColor,
            'location' => $this->ressource->name,
            'className' => $className
        );
    }
}