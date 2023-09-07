<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\ApplicationActionRequest;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        request()->user()->can('viewApplicationsReport');

        $applications = Application::query()->paginate(10);

        return view('applications.index', compact(['applications']));
    }

    public function pending(): View
    {
        $actionUrl = '';
        $applications = Application::query();

        if (auth()->user()->role == UserRoleEnum::COORDINATOR) {
            $applications = $applications->waitingForCoordinator();

            $actionUrl = 'applications.coordinator-action';
        }

        if (auth()->user()->role == UserRoleEnum::MANAGER) {
            $applications = $applications->waitingForManager();

            $actionUrl = 'applications.manager-action';
        }

        $applications = $applications->paginate(10);

        return view('applications.pending', compact(['applications', 'actionUrl']));
    }

    public function coordinatorAction(ApplicationActionRequest $request, Application $application): RedirectResponse
    {
        $request->user()->can('coordinatorAction', $application);

        $application->update([
            'coordinator_action' => $request->validated()['action'],
            'coordinator_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'تم الرد على الطلب بنجاح');
    }

    public function managerAction(ApplicationActionRequest $request, Application $application): RedirectResponse
    {
        $request->user()->can('managerAction', $application);

        $application->update([
            'manager_action' => $request->validated()['action'],
            'manager_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'تم الرد على الطلب بنجاح');
    }

    public function store(ApplicationRequest $request): RedirectResponse
    {
        $cv= $request->file('cv')->store('files', 'public');

        Application::create(array_merge($request->validated(), ['cv' => $cv]));

        return redirect()->back()->with('success', 'تم ارسال طلبك بنجاح');
    }
}
