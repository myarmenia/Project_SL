<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventFieldsUpdateRequest;
use App\Models\Address;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang,Request $request): RedirectResponse
    {
        $event_id = $this->store($request->bibliography_id);

        return redirect()->route('event.edit', ['event' => $event_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bibliography_id)
    {
        return $this->eventService->store($bibliography_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Event $event)
    {
        // Session::put('route', 'organization.create');
        // Session::put('model', $man);

        // $address = Session::get('modelId');
        // if ($address){
        //     $address = Address::find($address);
        // }
        // Session::put('route', ['name' =>'event.edit', 'id'=> $event->id]);
        // Session::put('model', $event);


        // $address = Address::find($organization);


        return view('event.index', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($lang, EventFieldsUpdateRequest $request, Event $event)
    {
        // dd($request->all());
        $updated_field = $this->eventService->update($event, $request->validated());

        return response()->json(['result' => $updated_field]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
