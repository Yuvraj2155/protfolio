<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Setting;

class AdminController extends Controller
{
    private function checkAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin/login');
        }
        return null;
    }

    public function login()
    {
        return Inertia::render('Admin/Login');
    }

    public function doLogin(Request $request)
    {
        $request->validate(['password' => 'required']);

        if ($request->password === config('app.admin_password')) {
            session(['admin_logged_in' => true]);
            return redirect('/admin');
        }

        return back()->withErrors(['password' => 'Wrong password.']);
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect('/admin/login');
    }

    public function dashboard()
    {
        if ($r = $this->checkAuth()) return $r;

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'projects' => Project::count(),
                'skills'   => Skill::count(),
            ]
        ]);
    }

    public function projects()
    {
        if ($r = $this->checkAuth()) return $r;
        return Inertia::render('Admin/Projects', [
            'projects' => Project::orderBy('sort_order')->get()
        ]);
    }

    public function storeProject(Request $request)
    {
        if ($r = $this->checkAuth()) return $r;
        $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'tags'        => 'required|string',
            'stack'       => 'required|string',
        ]);

        Project::create([
            'title'       => $request->title,
            'description' => $request->description,
            'tags'        => array_map('trim', explode(',', $request->tags)),
            'github_url'  => $request->github_url,
            'live_url'    => $request->live_url,
            'stack'       => $request->stack,
            'visible'     => true,
            'sort_order'  => Project::max('sort_order') + 1,
        ]);

        return redirect('/admin/projects')->with('success', 'Project added.');
    }

    public function updateProject(Request $request, Project $project)
    {
        if ($r = $this->checkAuth()) return $r;
        $project->update([
            'title'       => $request->title,
            'description' => $request->description,
            'tags'        => array_map('trim', explode(',', $request->tags)),
            'github_url'  => $request->github_url,
            'live_url'    => $request->live_url,
            'stack'       => $request->stack,
            'visible'     => $request->visible ?? true,
        ]);

        return redirect('/admin/projects')->with('success', 'Project updated.');
    }

    public function deleteProject(Project $project)
    {
        if ($r = $this->checkAuth()) return $r;
        $project->delete();
        return redirect('/admin/projects')->with('success', 'Project deleted.');
    }

    public function skills()
    {
        if ($r = $this->checkAuth()) return $r;
        return Inertia::render('Admin/Skills', [
            'skills' => Skill::orderBy('sort_order')->get()
        ]);
    }

    public function storeSkill(Request $request)
    {
        if ($r = $this->checkAuth()) return $r;
        $request->validate(['name' => 'required|string|max:100']);
        Skill::create(['name' => $request->name, 'sort_order' => Skill::max('sort_order') + 1]);
        return redirect('/admin/skills')->with('success', 'Skill added.');
    }

    public function deleteSkill(Skill $skill)
    {
        if ($r = $this->checkAuth()) return $r;
        $skill->delete();
        return redirect('/admin/skills')->with('success', 'Skill deleted.');
    }

    public function profile()
    {
        if ($r = $this->checkAuth()) return $r;
        return Inertia::render('Admin/Profile', [
            'settings' => Setting::pluck('value', 'key')
        ]);
    }

    public function updateProfile(Request $request)
    {
        if ($r = $this->checkAuth()) return $r;
        $fields = ['name', 'title', 'bio', 'location', 'linkedin', 'github_username', 'email', 'resume_url', 'open_to_work'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->$field);
            }
        }
        return redirect('/admin/profile')->with('success', 'Profile updated.');
    }
}