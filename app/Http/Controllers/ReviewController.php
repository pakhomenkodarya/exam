<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create($id)
    {
        $appointment = Appointment::where('user_id', Auth::id())->findOrFail($id);
        return view('reviews.create', compact('appointment'));
    }
    
    public function store(Request $request, $id)
    {
        // Находим запись
        $appointment = Appointment::where('user_id', Auth::id())->findOrFail($id);
        // Проверка: есть ли уже отзыв
        $existingReview = Review::where('user_id', Auth::id())
            ->where('appointment_id', $appointment->id)
            ->exists();
        if ($existingReview) {
            return redirect()->route('appointments.index')
                ->with('error', 'Вы уже оставляли отзыв на эту запись');
        }
        // Валидация
        $data = $request->validate([
            'review' => 'required|string|min:3|max:1000',
        ], [
            'review.required' => 'Введите текст отзыва',
            'review.min' => 'Отзыв должен содержать минимум 3 символа',
            'review.max' => 'Отзыв не должен превышать 1000 символов',
        ]);
        // Создание отзыва
        $review = Review::create([
            'user_id' => Auth::id(),
            'appointment_id' => $appointment->id,
            'review' => $data['review']
        ]);
        
        return redirect()->route('appointments.index')
            ->with('success', 'Спасибо за ваш отзыв!');
    }
}