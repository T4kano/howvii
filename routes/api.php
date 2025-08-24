use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::apiResource('property_types', PostController::class);
Route::apiResource('properties', PostController::class);
Route::apiResource('customers', PostController::class);
Route::apiResource('payments', PostController::class);
