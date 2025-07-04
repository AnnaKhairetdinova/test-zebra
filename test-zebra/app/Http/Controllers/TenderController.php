<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenderRequest;
use App\Models\Tender;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    /**
     * Список тендеров
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Tender::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        if ($request->has('date')) {
            $query->whereDate('updated_at', $request->query('date'));
        }

        $limit = $request->query('limit', 10);

        $tenders = $query->paginate($limit);

        return response()->json([
            'data' => $tenders->items(),
            'pagination' => [
                'current_page' => $tenders->currentPage(),
                'pages' => $tenders->lastPage(),
                'total' => $tenders->total(),
            ],
        ]);
    }


    /**
     * Создание тендера
     *
     * @param StoreTenderRequest $request
     * @return JsonResponse
     */
    public function store(StoreTenderRequest $request): JsonResponse
    {
        $tender = Tender::create($request->validated());

        return response()->json(['id' => $tender->id], 201);
    }

    /**
     * Просмотр конкретного тендера
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $tender = Tender::find($id);

        if (!$tender) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($tender);
    }
}
