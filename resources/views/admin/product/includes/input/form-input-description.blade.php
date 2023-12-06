@php $oldInputData = old() @endphp
@unless (empty($oldInputData))
    @for ($i = 0; $i < count($oldInputData['product_description']); $i++)
        @php 
            $nullTitleValue = is_null($oldInputData['title_product_description'][$i]);
            $nullBodyValue = is_null($oldInputData['product_description'][$i]);
            $firstLoop = ($i === 0); // Shorthand return true / false
            $isDescInputNull = (is_null($oldInputData['title_product_description'][$i]) || is_null($oldInputData['product_description'][$i]));
            $isFirstLoopNull = $firstLoop && $isDescInputNull;
            $isAfterFirstLoopNull = !$firstLoop && $isDescInputNull;
        @endphp
        @continue($isAfterFirstLoopNull)
        <div class="item-input-group input-description | mb-4">
            <label for="form-input-desc-{{ $i+1 }}" class="block text-sm mb-1">Deskripsi{{ $firstLoop ? '*' : '' }}</label>
            <div id="form-input-desc-{{ $i+1 }}" class="w-full">
                <div class="flex gap-2 mb-4">
                    <input type="text" name="title_product_description[]" placeholder="Label deskripsi..."
                        @class([
                            'w-full h-10 border border-[#ccc] rounded py-2 px-3 focus:ring-transparent',
                            'is-invalid' => $firstLoop && $nullTitleValue,
                        ])
                        value="{{ $oldInputData['title_product_description'][$i] }}">
                    <button type="button" id="btn-{{ $firstLoop ? 'add' : 'del' }}-desc" 
                        @class([
                            'btn-desc-adjuster | text-white rounded py-2 px-3', 
                            'bg-[#0079c2]' => $firstLoop,
                            'bg-[#c33]' => !$firstLoop,
                        ]) 
                        @unless ($firstLoop) echo data-target-description="form-input-desc-{{ $i+1 }}" @endunless
                        ><div class="icon | h-6">
                            <i @class([
                                'ri-add-fill' => $firstLoop,
                                'ri-delete-bin-6-line' => !$firstLoop,
                            ])></i>
                        </div>
                    </button>
                </div>
                <textarea name="product_description[]" cols="30" rows="4" placeholder="Deskripsi..." 
                    @class([
                        'w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent',
                        'is-invalid' => $nullBodyValue,
                    ])
                    >{{ $oldInputData['product_description'][$i] }}</textarea>
            </div>
            @includeWhen($isFirstLoopNull, 'admin.components.validation-message', [
                'field' => 'product_description.0', 
                'validation' => 'customValidation', 
                'customMessage' => [
                        'The product description field is required.'
                    ]
                ]
            )
        </div>
    @endfor
@else 
    @php $dataDescriptions = isset($data) ? $data['product_descriptions'] : [] @endphp
    @forelse ($dataDescriptions as $index => $dataDescription)
        @php $firstLoop = $loop->first @endphp
        <div class="item-input-group input-description | mb-4">
            <label for="form-input-desc-{{ $index+1 }}" class="block text-sm mb-1">Deskripsi {{ $firstLoop ? '*' : '' }}</label>
            <div id="form-input-desc-{{ $index+1 }}" class="w-full">
                <div class="flex gap-2 mb-4">
                    <input type="text" name="title_product_description[]" placeholder="Label deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 focus:ring-transparent" value="{{ $dataDescription['title_product_description'] }}" @required($firstLoop)>
                    <button type="button" id="btn-{{ $firstLoop ? 'add' : 'del' }}-desc" 
                        @class([
                            'btn-desc-adjuster | text-white rounded py-2 px-3', 
                            'bg-[#0079c2]' => $firstLoop,
                            'bg-[#c33]' => !$firstLoop,
                        ])
                        @unless ($firstLoop) echo data-target-description="form-input-desc-{{ $index+1 }}" @endunless
                        ><div class="icon | h-6">
                            <i @class([
                                'ri-add-fill' => $firstLoop,
                                'ri-delete-bin-6-line' => !$firstLoop,
                            ])></i>
                        </div>
                    </button>
                </div>
                <textarea name="product_description[]" cols="30" rows="4" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent" @required($firstLoop)>{{ $dataDescription['product_description'] }}</textarea>
            </div>
        </div>
    @empty
        <div class="item-input-group input-description | mb-4">
            <label for="form-input-desc-1" class="block text-sm mb-1">Deskripsi*</label>
            <div id="form-input-desc-1" class="w-full">
                <div class="flex gap-2 mb-4">
                    <input type="text" name="title_product_description[]" placeholder="Label deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
                    <button type="button" id="btn-add-desc" class="btn-desc-adjuster | bg-[#0079c2] text-white rounded py-2 px-3">
                        <div class="icon | h-6"><i class="ri-add-fill"></i></div>
                    </button>
                </div>
                <textarea name="product_description[]" cols="30" rows="4" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
            </div>
        </div>
    @endforelse
@endunless
