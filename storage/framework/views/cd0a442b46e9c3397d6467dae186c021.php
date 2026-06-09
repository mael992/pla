<?php $__env->startSection('title', 'Contact — PlanEx'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8" style="max-width:700px">

            <div class="text-center mb-4">
                <h1 class="fw-bold" style="font-size:1.7rem;">Bienvenue sur la page de contact de PlanEx</h1>
                <p class="text-muted mt-2" style="font-size:0.97rem;">
                    Vous avez une question, un problème ou une suggestion&nbsp;? Remplissez le formulaire ci-dessous.
                    Notre équipe vous répondra par e-mail dans les plus brefs délais.
                </p>
            </div>

            <div class="card shadow-sm border-0" style="border-radius:12px;overflow:hidden;">
                <div class="card-header py-3 px-4" style="background:#111;border-bottom:3px solid #e30613;">
                    <span class="fw-semibold text-white" style="font-size:1rem;">Nouveau ticket de support</span>
                </div>
                <div class="card-body p-4">

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('contact.submit')); ?>" enctype="multipart/form-data" id="contactForm" novalidate>
                        <?php echo csrf_field(); ?>

                        
                        <div class="mb-3">
                            <label for="question_1" class="form-label fw-semibold">Votre demande concerne <span class="text-danger">*</span></label>
                            <select id="question_1" name="question_1" class="form-select <?php $__errorArgs = ['question_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- Sélectionnez une catégorie --</option>
                                <option value="connexion"   <?php echo e(old('question_1') === 'connexion'   ? 'selected' : ''); ?>>Problème de connexion</option>
                                <option value="anomalies"  <?php echo e(old('question_1') === 'anomalies'   ? 'selected' : ''); ?>>Anomalies / Incidents</option>
                                <option value="suggestion" <?php echo e(old('question_1') === 'suggestion'  ? 'selected' : ''); ?>>Suggestion</option>
                                <option value="abonnement" <?php echo e(old('question_1') === 'abonnement'  ? 'selected' : ''); ?>>Abonnement</option>
                                <option value="autre"      <?php echo e(old('question_1') === 'autre'       ? 'selected' : ''); ?>>Autre</option>
                            </select>
                            <?php $__errorArgs = ['question_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3" id="q2Wrapper" style="display:none;">
                            <label for="question_2" class="form-label fw-semibold">Précisez votre demande <span class="text-danger">*</span></label>
                            <select id="question_2" name="question_2" class="form-select <?php $__errorArgs = ['question_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">-- Sélectionnez --</option>
                            </select>
                            <?php $__errorArgs = ['question_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold">Décrivez votre problème <span class="text-danger">*</span></label>
                            <textarea id="message" name="message" class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                rows="6" maxlength="2500" placeholder="Expliquez votre demande en détail..." required><?php echo e(old('message')); ?></textarea>
                            <div class="d-flex justify-content-end mt-1">
                                <small id="charCount" class="text-muted">0 / 2500 caractères</small>
                            </div>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Votre adresse e-mail <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="exemple@email.com" value="<?php echo e(old('email')); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Documents PDF <span class="text-muted fw-normal">(optionnel, max 2 fichiers)</span></label>
                            <input type="file" name="pdfs[]" class="form-control <?php $__errorArgs = ['pdfs.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                accept=".pdf,application/pdf" multiple>
                            <div class="form-text">Formats acceptés : PDF — 10 Mo max par fichier</div>
                            <?php $__errorArgs = ['pdfs.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Photos / Images <span class="text-muted fw-normal">(optionnel, max 10 fichiers)</span></label>
                            <input type="file" name="images[]" class="form-control <?php $__errorArgs = ['images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                accept="image/*" multiple>
                            <div class="form-text">Formats acceptés : JPG, PNG, GIF, WEBP — 10 Mo max par fichier</div>
                            <?php $__errorArgs = ['images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="text-end">
                            <button type="submit" id="submitBtn" class="btn btn-danger px-4 py-2 fw-semibold" disabled>
                                Envoyer ma demande
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php if(session('ticket_submitted')): ?>
<div class="modal fade" id="ticketModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0" style="background:#111;">
                <h5 class="modal-title text-white fw-bold">Demande envoyée</h5>
            </div>
            <div class="modal-body pt-3 pb-4 px-4">
                <div class="text-center mb-3">
                    <span style="font-size:3rem;">&#10003;</span>
                </div>
                <p class="text-center mb-0" style="font-size:1rem;">
                    Nous avons bien pris en compte votre demande.<br>
                    Nous vous recontacterons par e-mail dans les plus brefs délais.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-dark px-4" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('ticketModal'));
        modal.show();
    });
</script>
<?php endif; ?>

<script>
const subQuestions = {
    'connexion':  ['Problème de nom d\'utilisateur ?', 'Problème de réinitialisation de mot de passe ?', 'Autre'],
    'anomalies':  ['Problème lorsqu\'on ajoute une anomalie', 'Problème lorsqu\'on ajoute une zone', 'Problème lorsqu\'on veut créer un PDF', 'Problème lors de l\'affichage de l\'onglet « Tableau des Anomalies »', 'Autre'],
    'suggestion': ['Ajouter une nouvelle Traduction', 'Ajouter certaines informations', 'Autre'],
    'abonnement': ['Je souhaiterais être contacté pour réguler mon abonnement', 'Je souhaiterais avoir une nouvelle option d\'abonnement', 'Je souhaiterais prendre contact avec vous pour plus de détails sur l\'abonnement', 'Autre'],
    'autre':      ['Je n\'arrive pas à accéder à mes onglets', 'Mon problème ne figure dans aucune de ces réponses et je souhaiterais une autre aide']
};

const q1        = document.getElementById('question_1');
const q2        = document.getElementById('question_2');
const q2Wrap    = document.getElementById('q2Wrapper');
const msgArea   = document.getElementById('message');
const emailInp  = document.getElementById('email');
const submitBtn = document.getElementById('submitBtn');
const charCount = document.getElementById('charCount');

function populateQ2(val) {
    q2.innerHTML = '<option value="">-- Sélectionnez --</option>';
    if (val && subQuestions[val]) {
        subQuestions[val].forEach(function(opt) {
            var o = document.createElement('option');
            o.value = opt;
            o.textContent = opt;
            q2.appendChild(o);
        });
        q2Wrap.style.display = '';
    } else {
        q2Wrap.style.display = 'none';
        q2.value = '';
    }
}

// Restaurer les anciennes valeurs après erreur de validation
(function(){
    var oldQ1 = <?php echo json_encode(old('question_1', ''), 512) ?>;
    var oldQ2 = <?php echo json_encode(old('question_2', ''), 512) ?>;
    if (oldQ1) {
        populateQ2(oldQ1);
        if (oldQ2) { q2.value = oldQ2; }
    }
    if (msgArea.value.length > 0) {
        charCount.textContent = msgArea.value.length + ' / 2500 caractères';
    }
    checkForm();
})();

q1.addEventListener('change', function () {
    populateQ2(this.value);
    checkForm();
});
q2.addEventListener('change', checkForm);
msgArea.addEventListener('input', function () {
    charCount.textContent = this.value.length + ' / 2500 caractères';
    checkForm();
});
emailInp.addEventListener('input', checkForm);

function checkForm() {
    var q1ok    = q1.value !== '';
    var q2ok    = q2Wrap.style.display !== 'none' && q2.value !== '';
    var msgok   = msgArea.value.trim().length >= 1;
    var emailok = emailInp.value.trim() !== '' && emailInp.validity.valid;
    submitBtn.disabled = !(q1ok && q2ok && msgok && emailok);
}

checkForm();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/contact.blade.php ENDPATH**/ ?>