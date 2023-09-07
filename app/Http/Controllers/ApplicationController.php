<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\ApplicationActionRequest;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewApplicationsReport', Application::class);

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
        $this->authorize('coordinatorAction', $application);

        $application->update([
            'coordinator_action' => $request->validated()['action'],
            'coordinator_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'تم الرد على الطلب بنجاح');
    }

    public function managerAction(ApplicationActionRequest $request, Application $application): RedirectResponse
    {
        $this->authorize('managerAction', $application);

        $application->update([
            'manager_action' => $request->validated()['action'],
            'manager_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'تم الرد على الطلب بنجاح');
    }

    public function store(ApplicationRequest $request): RedirectResponse | JsonResponse
    {
        $cv = $request->file('cv')->store('files', 'public');

        Application::create(array_merge($request->validated(), ['cv' => $cv]));

        if ($request->wantsJson()) {
            return response()->json('تم ارسال طلبك بنجاح');
        }

        return redirect()->back()->with('success', 'تم ارسال طلبك بنجاح');
    }
}
