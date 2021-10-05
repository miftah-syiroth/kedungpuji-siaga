<x-app-layout>
    <x-slot name="header">
        {{-- {{ __('Show Penduduk') }} --}}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <ul>
                    <li>
                        tampilkan semua atribut personal dari tabel penduduk
                    </li>
                    <li>
                        tampilkan tabel keluarga dan anggota keluarga dia
                    </li>
                    <li>
                        jika dia sudah menikah atau memiliki pasangan, tampilkan identitas pasangan dan status kb
                    </li>
                    <li>
                        jika dia wanita memiliki relasi ke PregnantWomen, tampilkan data riwayat kehamilan yang akan link ke halaman prenatal class
                    </li>
                    <li>
                        jika dia memiliki relasi ke laporan nifas, tampilkan, ini dibuat pada iterasi 2
                    </li>
                    <li>
                        jika dia memiliki relasi ke posyandu anak, tampilkan, ini dibuat pada iterasi 2
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- komponen data personal --}}
    <div class="py-4">
        <div>
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 justify-center text-center">
                        Data Personal
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Nama
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                               : {{ $person->name  }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                NIK
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                               : {{ $person->nik  }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Tempat, tanggal lahir
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                               : {{ $person->place_of_birth . ', ' . $person->date_of_birth->isoFormat('DD MMMM Y') . ' (' . $person->date_of_birth->age . ' tahun)'  }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Jenis Kelamin
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->sex->sex }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Agama
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->religion->religion }}
                            </dd>
                        </div>
                        
                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Golongan Darah
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->bloodGroup->group }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Disabilitas
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->is_cacat == true ? $person->disability->type : '-' }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Pendidikan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->education->education }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Ibu Kandung
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->mother->name ?? '-' }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Ayah Kandung
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->father->name ?? '-' }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Status Anggota Keluarga
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <p>
                                    : {{ $person->familyStatus->status . ' dari ' }} 
                                    <a href="/people/{{ $person->family->leader->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $person->family->leader->name }}</a>
                                </p>
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Status Pernikahan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- kalau laki2 maka tampil istri-istrinya --}}
                                @if ($person->sex_id == 1) 

                                @foreach ($person->wifes as $wife)
                                <p>
                                    : {{ $wife->wife->maritalStatus->status }} dengan 
                                    <a href="/people/{{ $wife->wife->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $wife->wife->name }}</a>
                                </p>
                                @endforeach

                                @else
                                <p>
                                    : {{ $person->maritalStatus->status }} dengan 
                                    <a href="/people/{{ $person->husband->husband->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $person->husband->husband->name }}</a>
                                </p>
                                @endif
                                
                            </dd>
                        </div>
                        

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Status Pendaftaran
                            </dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2 flex flex-wrap content-center items-center">
                                <div>
                                    {{-- : {{ $participant->status->status }} --}}
                                </div>

                                selama statusnya blm selesai atau kadaluwarsa maka tampilkan
                                {{-- @if ($formActionVisible == true) --}}
                                <div class="px-4 content-center justify-center">
                                    <form wire:submit.prevent="setParticipantStatus">
                                        <label class="block">
                                           <select wire:model="status" class="text-xs h-0.5">
                                                <option hidden>Pilih Tindakan</option>
                                                {{-- @foreach ($statuses as $status) --}}
                                                {{-- {{-- <option value="{{ $status->id }}" class="text-xs h-0.5">{{ $status->status }}</option> --}} --}}
                                                {{-- @endforeach --}}
                                            </select>
                                            <button class="ml-2 py-1 px-3 bg-indigo-600 rounded-lg text-white" type="submit">pilih</button>
                                        </label>
                                    </form>
                                </div>
                                {{-- @endif --}}
                                
                                
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Kelas
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- : {{ $participant->kelas->nama }} --}}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Waktu Pelaksanaan TOEFL
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- {{-- : {{ $participant->kelas->pelaksanaan->isoFormat('D MMMM Y, H:mm') }} ({{ $participant->kelas->pelaksanaan->diffForHumans() }})  --}} --}}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Waktu Batas Pendaftaran Kelas
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- {{-- : {{ $participant->kelas->pendaftaran->isoFormat('D MMMM Y, H:mm') }} ({{ $participant->kelas->pendaftaran->diffForHumans() }})  --}} --}}
                            </dd>
                        </div>
                    
                        kalau ada permission melihat hasil (sudah selesai mengerjakan)
                        
                        {{-- @if ($participant->hasAnyPermission('melihat skor')) --}}
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Hasil Kerja TOEFL
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- @livewire('toefl.toefl-score', ['user' => $participant]) --}}
                            </dd>
                        </div>
                        {{-- @endif --}}
                    
            
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Attachments
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div>
                                    <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <!-- Heroicon name: solid/paper-clip -->
                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    bukti pembayaran 
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <button wire:click="downloadReceipt" class="font-medium text-indigo-600 hover:text-indigo-500">Download</button>
                                            </div>
                                        </li>
                
    
                                        download certificate kalau ada isinya
                                        {{-- @if ($participant->certificate) --}}
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <!-- Heroicon name: solid/paper-clip -->
                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    sertifikat toefl
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <button wire:click="downloadCertificate" class="font-medium text-indigo-600 hover:text-indigo-500">Download</button>
                                            </div>
                                        </li>
                                        {{-- @endif --}}
                                        
                                    </ul>
                                </div>

                                tampilakan form upload sertifikat jika status sudah selesai
                                {{-- @if ($participant->status_id == 5) --}}
                                <div>
                                    <div class="mt-5 md:mt-0">
                                        <form wire:submit.prevent="uploadCertificate">
                                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                                <div class="px-4 bg-white space-y-2 sm:p-6">
                                                    <label class="text-right block text-sm font-medium text-gray-700">
                                                        Upload Sertifikat
                                                    </label>
                                                    <div class="mt-1 flex justify-end items-center">
                                                        <input wire:model="certificate" type="file" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    </div>
                                                    {{-- @error('certificate') <span class="text-red-600 font-semibold flex justify-end">{{ $message }}</span> @enderror --}}
                                                </div>
                                                <div class="px-4 pb-3 bg-gray-50 text-right sm:px-6">
                                                    <button type="submit" class="inline-flex justify-center py-1 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div>
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 justify-center text-center">
                        Data Personal
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Nama
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                               : {{ $person->name  }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                NIK
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                               : {{ $person->nik  }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Tempat, tanggal lahir
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                               : {{ $person->place_of_birth . ', ' . $person->date_of_birth->isoFormat('DD MMMM Y') . ' (' . $person->date_of_birth->age . ' tahun)'  }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Jenis Kelamin
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->sex->sex }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Agama
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->religion->religion }}
                            </dd>
                        </div>
                        
                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Golongan Darah
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->bloodGroup->group }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Ibu Kandung
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->mother->name ?? '-' }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Ayah Kandung
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->father->name ?? '-' }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Disabilitas
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->is_cacat == true ? $person->disability->type : '-' }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Pendidikan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $person->education->education }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Status Pendaftaran
                            </dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2 flex flex-wrap content-center items-center">
                                <div>
                                    {{-- : {{ $participant->status->status }} --}}
                                </div>

                                selama statusnya blm selesai atau kadaluwarsa maka tampilkan
                                {{-- @if ($formActionVisible == true) --}}
                                <div class="px-4 content-center justify-center">
                                    <form wire:submit.prevent="setParticipantStatus">
                                        <label class="block">
                                           <select wire:model="status" class="text-xs h-0.5">
                                                <option hidden>Pilih Tindakan</option>
                                                {{-- @foreach ($statuses as $status) --}}
                                                {{-- {{-- <option value="{{ $status->id }}" class="text-xs h-0.5">{{ $status->status }}</option> --}} --}}
                                                {{-- @endforeach --}}
                                            </select>
                                            <button class="ml-2 py-1 px-3 bg-indigo-600 rounded-lg text-white" type="submit">pilih</button>
                                        </label>
                                    </form>
                                </div>
                                {{-- @endif --}}
                                
                                
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Kelas
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- : {{ $participant->kelas->nama }} --}}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Waktu Pelaksanaan TOEFL
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- {{-- : {{ $participant->kelas->pelaksanaan->isoFormat('D MMMM Y, H:mm') }} ({{ $participant->kelas->pelaksanaan->diffForHumans() }})  --}} --}}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Waktu Batas Pendaftaran Kelas
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- {{-- : {{ $participant->kelas->pendaftaran->isoFormat('D MMMM Y, H:mm') }} ({{ $participant->kelas->pendaftaran->diffForHumans() }})  --}} --}}
                            </dd>
                        </div>
                    
                        kalau ada permission melihat hasil (sudah selesai mengerjakan)
                        
                        {{-- @if ($participant->hasAnyPermission('melihat skor')) --}}
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Hasil Kerja TOEFL
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{-- @livewire('toefl.toefl-score', ['user' => $participant]) --}}
                            </dd>
                        </div>
                        {{-- @endif --}}
                    
            
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Attachments
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div>
                                    <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <!-- Heroicon name: solid/paper-clip -->
                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    bukti pembayaran 
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <button wire:click="downloadReceipt" class="font-medium text-indigo-600 hover:text-indigo-500">Download</button>
                                            </div>
                                        </li>
                
    
                                        download certificate kalau ada isinya
                                        {{-- @if ($participant->certificate) --}}
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <!-- Heroicon name: solid/paper-clip -->
                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    sertifikat toefl
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <button wire:click="downloadCertificate" class="font-medium text-indigo-600 hover:text-indigo-500">Download</button>
                                            </div>
                                        </li>
                                        {{-- @endif --}}
                                        
                                    </ul>
                                </div>

                                tampilakan form upload sertifikat jika status sudah selesai
                                {{-- @if ($participant->status_id == 5) --}}
                                <div>
                                    <div class="mt-5 md:mt-0">
                                        <form wire:submit.prevent="uploadCertificate">
                                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                                <div class="px-4 bg-white space-y-2 sm:p-6">
                                                    <label class="text-right block text-sm font-medium text-gray-700">
                                                        Upload Sertifikat
                                                    </label>
                                                    <div class="mt-1 flex justify-end items-center">
                                                        <input wire:model="certificate" type="file" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    </div>
                                                    {{-- @error('certificate') <span class="text-red-600 font-semibold flex justify-end">{{ $message }}</span> @enderror --}}
                                                </div>
                                                <div class="px-4 pb-3 bg-gray-50 text-right sm:px-6">
                                                    <button type="submit" class="inline-flex justify-center py-1 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-4 py-4 rounded-lg shadow-2xl">
                <h4 class="mb-4 text-lg font-semibold text-gray-600">
                    Responsive cards
                </h4>
                <div class="grid gap-6 mb-8 grid-cols-3">
                    <!-- Card -->
                    {{-- @for ($i = 0; $i < 6; $i++) --}}
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border-2">
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Pending contacts
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                35
                            </p>
                        </div>
                    </div>
                    {{-- @endfor --}}
                </div>
            </div>
        </div>
    </div>


<!-- Responsive cards -->



    
</x-app-layout>