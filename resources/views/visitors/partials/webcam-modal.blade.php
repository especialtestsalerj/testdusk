<div
    x-init="//VMasker($refs.cpf).maskPattern(cpfmask);

    window.Webcam.attach('#webcam');

    window.take_snapshot = function() {
        window.Webcam.snap(function(data_uri) {
            const fileInput = document.querySelector('input[type=file]');
            const myFile = base64ToFile(data_uri, 'webcam-picture.jpg');

            // Now let's create a DataTransfer to get a FileList
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(myFile);
            fileInput.files = dataTransfer.files;

            var inputEvent = new Event('input');
            fileInput.dispatchEvent(inputEvent);
            var changeEvent = new Event('change');
            fileInput.dispatchEvent(changeEvent);
        });
    }"
>

</div>

<!-- Modal -->
<div
    wire:ignore.self class="modal fade" data-bs-keyboard="false" id="webcamModal"
     tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Webcam</h5>
                <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close"></button>
            </div>

            <div class="d-flex justify-content-evenly pt-3">
                <div>
                    <label for="webcam_file" class="btn btn-outline-primary">
                        <i class="fas fa-upload"></i>
                    </label>
                </div>
                <div class="{{ $webcam_file ? 'd-none' : ''}}">
                    <button type="button" wire:click="takeSnapshot" onclick="take_snapshot()"
                            class="btn btn-outline-primary">
                        <i class="fa-solid fa-camera"></i>
                    </button>
                </div>
                <div class="{{ $webcam_file ? '' : 'd-none' }}">
                    <button wire:click.prevent="removeWebcamFile" type="button" class="btn btn-outline-primary">
                        <i class="fas fa-eraser"></i>
                    </button>
                </div>
            </div>

            <div class="modal-body {{ $webcam_file ? 'd-none' : '' }}">
                <div style="height: 100%">
                    <div class="row control-group" transition="expand" wire:ignore>
                        <div class="form-group col-12 floating-label-form-group controls">
                            <div class="card text-center">
                                <div class="card-header">Webcam</div>
                                <div class="card-body d-flex justify-content-center">
                                    <div id="webcam"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row control-group" transition="expand">
                        <div class="form-group col-12 floating-label-form-group controls">
                            <div class="input-group">
                                <div class="custom-file">

                                    <input {{ $mode == 'update' ? 'disabled' : '' }} type="file" name="webcam_file"
                                           class="custom-file-input" id="webcam_file" wire:model="webcam_file"
                                           wire:change="removeWebcamFile" style="display: none;">
                                </div>

                                <div>
                                    @error('webcam_file')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
            @if ($webcam_file)
                <div class="modal-body">
                    <div class="row control-group" transition="expand" data-instance="{{ $iteration }}">
                        <div class="form-group col-12 floating-label-form-group controls">
                            <div class="card text-center">
                                <div class="card-header">Recortar foto</div>
                                <div class="card-body">
                                    <div class="d-flex flex-column justify-content-center" wire:ignore
                                         wire:key="force-rerender" x-data="{
                                             setUp() {
                                                 const cropper = new Cropper(document.getElementById('preview_webcam_file'), {
                                                     aspectRatio: 1 / 1,
                                                     autoCropArea: 1,
                                                     viewMode: 1,
                                                     crop(event) {
                                                         Livewire.emit('cropChanged', {
                                                             x: event.detail.x,
                                                             y: event.detail.y,
                                                             width: event.detail.width,
                                                             height: event.detail.height
                                                         });
                                                     }
                                                 })
                                             }
                                         }" x-intersect="setUp()">
                                        <div>
                                            <img id="preview_webcam_file"
                                                 src="{{ $webcam_data_uri ? $webcam_file : $webcam_file->temporaryUrl() }}"
                                                 class="img-fluid" style="max-height: 300px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" x-init="window.canvas = document.getElementById('canvas');
                     window.canvasBadge = document.getElementById('canvas-badge');
                     window.base64Input = document.getElementById('photo');

                     var ctx = canvas.getContext('2d');
                     var ctxBadge = canvasBadge.getContext('2d');
                     var image = new Image();
                     image.src = '{{ $webcam_data_uri ? $webcam_file : $webcam_file->temporaryUrl() }}'; // Replace with your image source

                     // When the image has loaded
                     image.onload = function() {
                         // Draw the image on the canvas, applying the crop
                         ctx.drawImage(image, {{ $x ?? 0 }}, {{ $y ?? 0 }}, {{ $width ?? 400 }}, {{ $height ?? 400 }}, 0, 0, canvas.width, canvas.height);
                         ctxBadge.drawImage(image, {{ $x ?? 0 }}, {{ $y ?? 0 }}, {{ $width ?? 400 }}, {{ $height ?? 400 }}, 0, 0, canvasBadge.width, canvasBadge.height);
                         base64Input.value = canvas.toDataURL()
                     };">
                        {{--        <canvas wire:ignore id="canvas" width="400" height="400"></canvas> --}}
                        <input wire:ignore id="photo" name="photo" type="hidden">
                    </div>
                </div>
            @endif
            <div class="modal-footer">
                <button data-bs-dismiss="modal" type="button" class="btn btn-secondary">Fechar</button>
            </div>
        </div>
    </div>
</div>
