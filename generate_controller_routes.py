import os

files = {
    'app/Http/Controllers/Admin/SettingController.php': r"""<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $groupedSettings = $this->settingService->getGroupedSettings();
        return view('admin.settings.index', compact('groupedSettings'));
    }

    public function update(Request $request, string $group)
    {
        // Dynamically resolve the correct FormRequest based on the group name
        $groupName = Str::studly($group);
        $requestClass = "\\App\\Http\\Requests\\Admin\\Settings\\Update{$groupName}Request";
        
        if (class_exists($requestClass)) {
            // This automatically resolves and validates the request
            app($requestClass);
        }

        try {
            $this->settingService->updateGroup($group, $request->all());
            return back()->with('success', ucfirst($group) . ' settings updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating settings: ' . $e->getMessage())->withInput();
        }
    }
    
    public function testSmtp(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);
        
        try {
            $this->settingService->testSmtp($request->except('test_email'), $request->test_email);
            return response()->json(['success' => true, 'message' => 'Test email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
""",
    'routes/admin/settings.php': r"""<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:Administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/test-smtp', [SettingController::class, 'testSmtp'])->name('settings.test-smtp');
    Route::post('/settings/{group}', [SettingController::class, 'update'])->name('settings.update');
});
"""
}

os.makedirs('app/Http/Controllers/Admin', exist_ok=True)
os.makedirs('routes/admin', exist_ok=True)
for path, content in files.items():
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)

print("Controller and routes generated.")
