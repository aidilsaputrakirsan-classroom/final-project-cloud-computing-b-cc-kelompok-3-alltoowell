<?php

if (!function_exists('room_image')) {
    function room_image($image)
    {
        if (!$image) {
            return 'https://via.placeholder.com/400';
        }

        if (str_starts_with($image, 'http')) {
            return $image;
        }

        return asset('storage/rooms/' . $image);
    }
}
