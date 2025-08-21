<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    use CanLoadRelationships;

    private array $relations = ['user'];

    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum')->except(['index', 'show', 'update']);
    //     $this->middleware('throttle:api')
    //         ->only(['store', 'destroy']);
    //     $this->authorizeResource(Attendee::class, 'attendee');
    // }

    public function index(Event $event)
    {
        Gate::authorize('viewAny', Attendee::class);
        $attendees = $this->loadRelationships(
            $event->attendees()->latest()
        );

        return AttendeeResource::collection(
            $attendees->paginate()
        );
    }

    public function store(Request $request, Event $event)
    {
        Gate::authorize('create', Attendee::class);
        $attendee = $this->loadRelationships(
            $event->attendees()->create([
                'user_id' => $request->user()->id
            ])
        );

        return response()->json([
            'message' => 'Successfully registered for event.',
            'attendee' => new AttendeeResource($attendee)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        Gate::authorize('view', $attendee);
        return new AttendeeResource(
            $this->loadRelationships($attendee)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Attendee $attendee)
    {
        Gate::authorize('delete', $attendee);
        $attendee->delete();

        return response(status: 204);
    }
}
