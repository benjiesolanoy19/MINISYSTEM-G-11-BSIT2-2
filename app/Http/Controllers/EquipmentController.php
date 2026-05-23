<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::orderBy('name')->get();
        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:available,borrowed,maintenance,lost',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['available_quantity'] = $validated['quantity'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('equipment_images', 'public');
            $validated['image'] = $path;


        }

        Equipment::create($validated);

        return redirect()->route('equipment.index')->with('success', 'Equipment added successfully!');
    }

    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:available,borrowed,maintenance,lost',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Update available quantity if total quantity changed
        $diff = $validated['quantity'] - $equipment->quantity;
        $validated['available_quantity'] = $equipment->available_quantity + $diff;

        // Handle image removal
        if ($request->has('remove_image') && $request->input('remove_image') === '1') {
            if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
                Storage::disk('public')->delete($equipment->image);
            }
            $validated['image'] = null;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
                Storage::disk('public')->delete($equipment->image);
            }
            
            $image = $request->file('image');
            $path = $image->store('equipment_images', 'public');
            $validated['image'] = $path;
        }

        $equipment->update($validated);

        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully!');
    }

    public function destroy(Equipment $equipment)
    {
        // Delete image if exists
        if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
            Storage::disk('public')->delete($equipment->image);
        }
        
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully!');
    }
}
