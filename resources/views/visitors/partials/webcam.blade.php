<button type="button" wire:click="takeSnapshot" onclick="take_snapshot()" style="border: none;
                        padding: 0;
                        background: none;"><i class="fa-solid fa-camera"></i></button>
<label for="webcam_file" style="cursor:pointer;">
    <i class="fas fa-upload"></i>
</label>
<button wire:click.prevent="removeWebcamFile" type="button" style="border: none;
        padding: 0;
        background: none;"><i class="fas fa-eraser"></i></button>

<div wire:ignore>
    <div id="webcam" style="width:640px; height:480px;"></div>
</div>

@if($webcam_file)
    <div data-instance="{{ $iteration }}">
        <div
            wire:ignore
            wire:key="force-rerender"
            x-data="{
                            setUp() {
                                const cropper = new Cropper(document.getElementById('preview_webcam_file'), {
                                    aspectRatio: 1/1,
                                    autoCropArea: 1,
                                    viewMode: 1,
                                    crop (event) {
                                        Livewire.emit('cropChanged', {
                                            x: event.detail.x,
                                            y: event.detail.y,
                                            width: event.detail.width,
                                            height: event.detail.height
                                        });
                                    }
                                })
                            }
                        }"
            x-init="setUp"
        >
            <div>
                <img id="preview_webcam_file" src="{{ $webcam_file->temporaryUrl() }}" style="width: 100%; max-width: 100%;">
            </div>
        </div>
    </div>

    <div
        class="row"
        x-init="
            var canvas = document.getElementById('canvas');
            const base64Input = document.getElementById('photo');

            var ctx = canvas.getContext('2d');
            var image = new Image();
            image.src = '{{ $webcam_file->temporaryUrl() }}'; // Replace with your image source

            // When the image has loaded
            image.onload = function() {
              // Draw the image on the canvas, applying the crop
              ctx.drawImage(image, {{$x ?? 0}}, {{$y ?? 0}}, {{$width ?? 400}}, {{$height ?? 400}}, 0, 0, canvas.width, canvas.height);
              base64Input.value = canvas.toDataURL()
            };
        "
    >
        <canvas wire:ignore id="canvas" width="400" height="400"></canvas>
        <input wire:ignore  id="photo" name="photo" type="hidden">
    </div>

@endif



<div class="row control-group" transition="expand">
    <div class="form-group col-12 floating-label-form-group controls">
        <div class="input-group">
            <div class="custom-file">



                <input
                    {{ $mode == 'update' ? 'disabled' : ''}}
                    type="file"
                    name="webcam_file"
                    class="custom-file-input"
                    id="webcam_file"
                    wire:model="webcam_file"
                    wire:change="removeWebcamFile"
                    style="display: none;"
                >
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

<div>


</div>
