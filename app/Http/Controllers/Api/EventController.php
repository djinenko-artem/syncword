<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventsResource;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(EventsResource::collection(Event::accessible()->get()));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(new EventsResource(Event::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->event_title = $request->event_title ?? $event->title;
        $event->event_start_date = $request->event_start_date ?? $event->event_start_date;
        $event->event_end_date = $request->event_end_date ?? $event->event_end_date;

        try {
            $event->save();

            return response()->json([
                'status' => true,
                'message' => __('main.event_updated')
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(UpdateEventRequest $request, Event $event)
    {
        try {
            $event->update($request->toArray());

            return response()->json([
                'status' => true,
                'message' => __('main.event_patched')
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            $event->delete();

            return response()->json([
                'status' => true,
                'message' => __('main.event_deleted')
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }
}
