<div
    x-init="window.Webcam.attach('#webcam');"
>

</div>

<!-- Modal -->
<div
    wire:ignore.self class="modal fade" data-bs-keyboard="false" id="webcamModal"
     tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Foto</h5>
                <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close"></button>
            </div>

            <div class="d-flex justify-content-evenly pt-3">
                <div class="{{ $hasWebcamPhoto ? 'd-none' : ''}}">
                    <button type="button" wire:click="takeSnapshot" onclick="take_snapshot()"
                            class="btn btn-outline-primary">
                        <i class="fa-solid fa-camera"></i>
                    </button>
                </div>
                <div class="{{ $hasWebcamPhoto ? 'd-none' : ''}}">
                    <label for="webcam_file" class="btn btn-outline-primary">
                        <i class="fas fa-upload"></i>
                    </label>
                </div>
                <div class="{{ $hasWebcamPhoto ? '' : 'd-none' }}">
                    <button wire:click.prevent="removeWebcamFile" onclick="remove_snapshot()" type="button" class="btn btn-outline-primary">
                        <i class="fas fa-eraser"></i>
                    </button>
                </div>
            </div>


            <div class="modal-body {{ $hasWebcamPhoto ? 'd-none' : '' }}">
                <div style="height: 100%">
                    <div class="row control-group" transition="expand" wire:ignore>
                        <div class="form-group col-12 floating-label-form-group controls">
                            <div class="card text-center">
                                <div class="card-header">Câmera</div>
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

                                    <input type="file" name="webcam_file"
                                           class="custom-file-input" id="webcam_file"
                                           wire:model="webcamFile"
                                           wire:change="imageUploaded"
                                           style="display: none;">
                                </div>

                                <div>
                                    @error('webcamFile')
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

                <div class="modal-body">

                    @if($hasWebcamPhoto && $webcamFile != no_photo())
                    <div class="row control-group" transition="expand" data-instance="{{ $iteration }}">
                        <div class="form-group col-12 floating-label-form-group controls">
                            <div class="card text-center">
                                <div class="card-header">Recortar Foto</div>
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
                                                 src="{{ $webcamDataUri ? $webcamFile : $webcamFile->temporaryUrl() }}"
                                                 class="img-fluid" style="max-height: 300px">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endIf

                    <div class="row" x-init="
                    window.dataCanvas = document.getElementById('canvas');
                    window.visibleCanvasBadge = document.getElementById('canvas-visible-badge');
                    window.base64Input = document.getElementById('photo');

                    var ctxDataBadge = dataCanvas.getContext('2d');
                    var ctxVisibleBadge = visibleCanvasBadge.getContext('2d');
                    var image = new Image();

                    window.clearCanvas('canvas')
                    window.clearCanvas('canvas-visible-badge')

                    @if($hasWebcamPhoto && $webcamFile != no_photo()) //has photo
                        image.src = '{{ $webcamDataUri ? $webcamFile : $webcamFile->temporaryUrl() }}';
                        image.onload = function() {
                            ctxDataBadge.drawImage(image, {{ $x ?? 0 }}, {{ $y ?? 0 }}, {{ $width ?? 400 }}, {{ $height ?? 400 }}, 0, 0, dataCanvas.width, dataCanvas.height);
                            ctxVisibleBadge.drawImage(image, {{ $x ?? 0 }}, {{ $y ?? 0 }}, {{ $width ?? 75 }}, {{ $height ?? 75 }}, 0, 0, visibleCanvasBadge.width, visibleCanvasBadge.height);

                            base64Input.value = dataCanvas.toDataURL() //fill image data transfered through the request
                        };
                     @else
                        base64Input.value = null //clear image data transfered through the request
                        image.src = '{{ no_photo() }}'
                        image.onload = function() {
                            ctxVisibleBadge.drawImage(image, {{ $x ?? 0 }}, {{ $y ?? 0 }}, {{ $width ?? 75 }}, {{ $height ?? 75 }}, 0, 0, visibleCanvasBadge.width, visibleCanvasBadge.height);
                        }
                    @endIf
"
                    >
{{--                            Photo in base64, that will be transfered through the request--}}
                            <input wire:ignore id="photo" name="photo" type="hidden">
                    </div>
                </div>



            <div class="modal-footer">
                <button data-bs-dismiss="modal" type="button" class="btn btn-secondary" title="Fechar Formulário"><i class="fas fa-check"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>
