<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function index(): View
    {
        $categories = category::query()
            ->orderBy('nama_category')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    
    public function create(): View
    {
        return view('categories.create');
    }

    public function store(StorecategoryRequest $request): RedirectResponse
    {
        category::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'category berhasil ditambahkan.');
    }

    
    public function show(category $category): View
    {
        return view('categories.show', compact('category'));
    }

    public function edit(category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdatecategoryRequest $request, category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'category berhasil diperbarui.');
    }

    public function destroy(category $category): RedirectResponse
    {
        if ($category->barang()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'category tidak dapat dihapus karena masih digunakan.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'category berhasil dihapus.');
    }
}
