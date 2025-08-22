<?php

namespace App\Livewire\Shortlink;

use Livewire\Component;
use App\Models\ShortLink;

class Index extends Component
{
    public $original_url;
    public $alias;
    public $search = '';

    protected $rules = [
        'original_url' => 'required',
        'alias' => 'required|string|unique:shortlinks,alias|min:3|max:50',
    ];

    protected $messages = [
        'original_url.required' => 'URL asli wajib diisi.',
        'original_url.url' => 'Format URL tidak valid.',
        'alias.required' => 'Alias wajib diisi.',
        'alias.unique' => 'Alias sudah digunakan, silakan pilih yang lain.',
        'alias.min' => 'Alias minimal 3 karakter.',
        'alias.max' => 'Alias maksimal 50 karakter.',
    ];

    public function createShortLink()
    {
        $validated = $this->validate();

        // ubah spasi jadi strip
        $alias = str_replace(' ', '-', $validated['alias']);
        
        ShortLink::create([
            'original_url' => $validated['original_url'],
            'alias' => $alias,
        ]);

        // reset form
        $this->reset(['original_url', 'alias']);

        // flash message
        session()->flash('successMessage', 'Shortlink berhasil dibuat!');
        return redirect()->route('shortlink.index');
    }

    public function delete($id)
    {
        $link = ShortLink::find($id);

        if ($link) {
            $link->delete();
            session()->flash('successMessage', 'Shortlink berhasil dihapus!');
            return redirect()->route('shortlink.index');

        } else {
            session()->flash('errorMessage', 'Shortlink tidak ditemukan.');
            return redirect()->route('shortlink.index');

        }
    }

    public function render()
    {
        $shortlinks = ShortLink::query()
            ->when($this->search, function ($query) {
                $query->where('alias', 'like', '%' . $this->search . '%')
                      ->orWhere('original_url', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.shortlink.index', [
            'shortlinks' => $shortlinks,
        ]);
    }
}
