<?php

if (!function_exists('room_image')) {
    function room_image($image)
    {
        if (!$image) {
            return 'https://via.placeholder.com/200x120?text=No+Image';
        }

        if (str_starts_with($image, 'http')) {
            return $image;
        }

        return asset('storage/' . $image);
    }
}
