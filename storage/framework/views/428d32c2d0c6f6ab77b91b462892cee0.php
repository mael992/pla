<?php if(isset($incident)): ?>
    <?php echo method_field('PUT'); ?>
<?php endif; ?>

<?php
    $disciplines = [
        'VRD', 'Génie civil', 'Structure métallique', 'Structure bâtiment',
        'Équipement', 'Tuyauterie', 'Calorifuge',
        'Électricité', 'Instrumentation', 'Automatisme',
    ];

    $statuts = [
        'na'       => __('messages.status_na'),
        'ouvert'   => __('messages.status_open'),
        'en_cours' => __('messages.status_in_progress'),
        'fermer'   => __('messages.status_closed'),
    ];

    $isFerme  = isset($incident) && $incident->statut === 'fermer';
    $isEdit   = isset($incident);
    $ro       = $isFerme ? 'readonly' : '';
    $dis      = $isFerme ? 'disabled' : '';
?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if($isFerme): ?>
    <div class="alert alert-warning mb-4">
        <?php echo __('messages.form_incident_closed'); ?>

    </div>
<?php endif; ?>

<div class="row g-3">

    
    <div class="col-md-6">
        <label class="form-label">
            <?php echo e(__('messages.field_discipline')); ?> <span class="text-danger">*</span>
        </label>
        <select name="discipline"
                class="form-select <?php $__errorArgs = ['discipline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                <?php echo e($dis); ?>>
            <option value=""><?php echo e(__('messages.select_placeholder')); ?></option>
            <?php $__currentLoopData = $disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d); ?>"
                    <?php echo e(old('discipline', $incident->discipline ?? '') === $d ? 'selected' : ''); ?>>
                    <?php echo e($d); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['discipline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_system')); ?></label>
        <input type="text" name="systeme" class="form-control"
               value="<?php echo e(old('systeme', $incident->systeme ?? '')); ?>"
               <?php echo e($ro); ?>>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_work_lot')); ?></label>
        <input type="text" name="lot_travail" class="form-control"
               value="<?php echo e(old('lot_travail', $incident->lot_travail ?? '')); ?>"
               <?php echo e($ro); ?>>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_zone')); ?></label>
        <select name="zone_id" class="form-select" <?php echo e($dis); ?>>
            <option value=""><?php echo e(__('messages.select_placeholder')); ?></option>
            <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($zone->id); ?>"
                    <?php echo e(old('zone_id', $incident->zone_id ?? '') == $zone->id ? 'selected' : ''); ?>>
                    <?php echo e($zone->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div class="form-text">
            <a href="<?php echo e(route('zones.index')); ?>" target="_blank"><?php echo e(__('messages.form_manage_zones')); ?></a>
        </div>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_chantier')); ?></label>
        <select name="chantier_id" class="form-select" <?php echo e($dis); ?>>
            <option value=""><?php echo e(__('messages.select_placeholder')); ?></option>
            <?php $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($chantier->id); ?>"
                    <?php echo e(old('chantier_id', $incident->chantier_id ?? '') == $chantier->id ? 'selected' : ''); ?>>
                    <?php echo e($chantier->nom); ?> — <?php echo e($chantier->localite); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div class="form-text">
            <a href="<?php echo e(route('chantiers.index')); ?>" target="_blank"><?php echo e(__('messages.chantiers_title')); ?></a>
        </div>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_label')); ?></label>
        <input type="text" name="etiquette" class="form-control"
               value="<?php echo e(old('etiquette', $incident->etiquette ?? '')); ?>"
               <?php echo e($ro); ?>>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_category')); ?></label>
        <select name="categorie" class="form-select" <?php echo e($dis); ?>>
            <option value=""><?php echo e(__('messages.select_placeholder')); ?></option>
            <?php $__currentLoopData = \App\Models\Incident::CATEGORIES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>"
                    <?php echo e(old('categorie', $incident->categorie ?? '') == $key ? 'selected' : ''); ?>>
                    <?php echo e($label); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_internal')); ?></label>
        <input type="text" name="interne" class="form-control"
               value="<?php echo e(old('interne', $incident->interne ?? '')); ?>"
               <?php echo e($ro); ?>>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_responsibility')); ?></label>
        <input type="text" name="responsabilite" class="form-control"
               value="<?php echo e(old('responsabilite', $incident->responsabilite ?? '')); ?>"
               <?php echo e($ro); ?>>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_status')); ?></label>
        <select name="statut" class="form-select" id="selectStatut"
                onchange="handleStatutChange(this.value)">
            <?php $__currentLoopData = $statuts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($val); ?>"
                    <?php echo e(old('statut', $incident->statut ?? 'ouvert') === $val ? 'selected' : ''); ?>>
                    <?php echo e($label); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_planned_closure')); ?></label>
        <input type="date" name="cloture_prevue" class="form-control"
               value="<?php echo e(old('cloture_prevue', isset($incident->cloture_prevue)
                   ? \Carbon\Carbon::parse($incident->cloture_prevue)->format('Y-m-d')
                   : '')); ?>"
               <?php echo e($ro); ?>>
    </div>

    
    <div class="col-md-6" id="rowDateCloture" style="display:none">
        <label class="form-label"><?php echo e(__('messages.field_closure_date')); ?></label>
        <input type="text" class="form-control bg-light"
               value="<?php echo e(isset($incident->date_cloture)
                   ? \Carbon\Carbon::parse($incident->date_cloture)->format('d/m/Y')
                   : now()->format('d/m/Y')); ?>"
               readonly>
        <input type="hidden" name="date_cloture"
               value="<?php echo e(isset($incident->date_cloture)
                   ? $incident->date_cloture
                   : now()->toDateString()); ?>">
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_qfc_open_form')); ?></label>
        <input type="text" name="qfc_ouvert" class="form-control"
               value="<?php echo e(old('qfc_ouvert', $incident->qfc_ouvert ?? '')); ?>"
               <?php echo e($ro); ?>>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo e(__('messages.field_qfc_closed_form')); ?></label>
        <input type="text" name="qfc_ferme" class="form-control"
               value="<?php echo e(old('qfc_ferme', $incident->qfc_ferme ?? '')); ?>"
               <?php echo e($ro); ?>>
    </div>

    
    <div class="col-12">
        <label class="form-label"><?php echo e(__('messages.field_description')); ?></label>
        <textarea name="description" rows="4" class="form-control"
                  <?php echo e($ro); ?>><?php echo e(old('description', $incident->description ?? '')); ?></textarea>
    </div>

    
    <div class="col-md-6">
        <label class="form-label">
            <?php echo e(__('messages.field_photo_open')); ?>

            <?php if(!$isEdit): ?>
                <span class="text-danger">*</span>
            <?php endif; ?>
            <span class="text-muted small"><?php echo e(__('messages.photo_sets_issue_date')); ?></span>
        </label>

        <?php if($isEdit && !empty($incident->photo_ouverte)): ?>
            <div id="previewPhotoOuverte" class="mb-2">
                <img src="<?php echo e(asset('storage/'.$incident->photo_ouverte)); ?>"
                     class="img-thumbnail" style="max-height: 120px;">
            </div>
            <button type="button"
                    class="btn btn-sm btn-outline-danger mb-2"
                    id="btnSupprimerOuverte"
                    onclick="supprimerPhoto('ouverte')">
                <?php echo e(__('messages.photo_delete')); ?>

            </button>
        <?php else: ?>
            <div id="previewPhotoOuverte"></div>
        <?php endif; ?>

        <input type="hidden" name="remove_photo_ouverte"
               id="removePhotoOuverte" value="0">

        <input type="file"
               name="photo_ouverte"
               id="inputPhotoOuverte"
               class="form-control <?php $__errorArgs = ['photo_ouverte'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               accept="image/*"
               <?php echo e(!$isEdit ? 'required' : ''); ?>

               <?php echo e($ro); ?>

               onchange="previewImage(this, 'previewPhotoOuverte', 'removePhotoOuverte',
                                      'btnSupprimerOuverte')">
        <?php $__errorArgs = ['photo_ouverte'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div class="col-md-6">
        <label class="form-label">
            <?php echo e(__('messages.field_photo_closed')); ?>

            <span class="text-muted small"><?php echo e(__('messages.photo_sets_update_date')); ?></span>
        </label>

        <?php if($isEdit && !empty($incident->photo_fermee)): ?>
            <div id="previewPhotoFermee" class="mb-2">
                <img src="<?php echo e(asset('storage/'.$incident->photo_fermee)); ?>"
                     class="img-thumbnail" style="max-height: 120px;">
            </div>
            <button type="button"
                    class="btn btn-sm btn-outline-danger mb-2"
                    id="btnSupprimerFermee"
                    onclick="supprimerPhoto('fermee')">
                <?php echo e(__('messages.photo_delete')); ?>

            </button>
        <?php else: ?>
            <div id="previewPhotoFermee"></div>
        <?php endif; ?>

        <input type="hidden" name="remove_photo_fermee"
               id="removePhotoFermee" value="0">

        <input type="file"
               name="photo_fermee"
               id="inputPhotoFermee"
               class="form-control"
               accept="image/*"
               <?php echo e($ro); ?>

               onchange="previewImage(this, 'previewPhotoFermee', 'removePhotoFermee',
                                      'btnSupprimerFermee')">
    </div>

</div>

<script>
function handleStatutChange(val) {
    document.getElementById('rowDateCloture').style.display =
        val === 'fermer' ? '' : 'none';
}
document.addEventListener('DOMContentLoaded', function () {
    const sel = document.getElementById('selectStatut');
    if (sel) handleStatutChange(sel.value);
});

function supprimerPhoto(type) {
    const preview  = document.getElementById('previewPhoto' + cap(type));
    const input    = document.getElementById('inputPhoto'   + cap(type));
    const hidden   = document.getElementById('removePhoto'  + cap(type));
    const btn      = document.getElementById('btnSupprimer' + cap(type));

    if (preview) preview.innerHTML = '';
    if (btn)     btn.style.display = 'none';
    if (input) input.value = '';
    if (hidden) hidden.value = '1';
}

function previewImage(input, previewId, hiddenId, btnId) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.getElementById(previewId);
        if (!preview) return;
        let img = preview.querySelector('img');
        if (!img) {
            img = document.createElement('img');
            img.className = 'img-thumbnail';
            img.style.maxHeight = '120px';
            preview.appendChild(img);
        }
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);

    const hidden = document.getElementById(hiddenId);
    if (hidden) hidden.value = '0';
    const btn = document.getElementById(btnId);
    if (btn) btn.style.display = '';
}

function cap(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>
<?php /**PATH C:\xampp\htdocs\planex\resources\views/partials/form.blade.php ENDPATH**/ ?>