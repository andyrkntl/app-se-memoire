 <!-- Formulaire caché -->
 <div class="activity-form collapse p-3 bg-light border-top">
     <form class="create-activity-form">
         @csrf
         <input type="hidden" name="jalon_id" value="{{ $jalon->id }}">

         <div class="form-row">
             <div class="col-md-4 mb-3">
                 <input type="text" name="nom_activite" class="form-control form-control-sm"
                     placeholder="Nom de l'activité" required>
             </div>

             <div class="col-md-3 mb-3">
                 <input type="date" name="date_debut" class="form-control form-control-sm" required>
             </div>

             <div class="col-md-3 mb-3">
                 <input type="date" name="date_prevue" class="form-control form-control-sm" required>
             </div>
             <div class="form-row">
                 <div class="col-md-4 mb-3">
                     <input type="text" name="lieu_reunion" class="form-control form-control-sm"
                         placeholder="Lieu de la réunion">
                 </div>
                 <div class="col-md-3 mb-3">
                     <input type="time" name="heure_reunion" class="form-control form-control-sm"
                         placeholder="Heure">
                 </div>
                 <div class="col-md-5 mb-3">
                     <input type="text" name="description_reunion" class="form-control form-control-sm"
                         placeholder="Description">
                 </div>
             </div>


             <div class="col-md-2 mb-3">
                 <button type="submit" class="btn btn-sm btn-success btn-block">
                     <i class="bi bi-check"></i>
                 </button>
             </div>
         </div>
     </form>
 </div>








 <style>
     .clickable-add-activity {
         transition: all 0.3s ease;
     }

     .clickable-add-activity:hover {
         background-color: #e9ecef !important;
     }

     .activity-form.collapsing {
         transition: height 0.3s ease;
     }

     .create-activity-form input {
         border-radius: 20px !important;
         padding: 0.5rem 1rem !important;
         font-size: 0.9em;
     }


     .badge {
         min-width: 80px;
         text-align: center;
         transition: opacity 0.3s ease;
     }

     .edit-activity {
         transition: transform 0.2s ease;
     }

     .edit-activity:hover {
         transform: scale(1.1);
     }
 </style>








 <script>
     document.addEventListener('DOMContentLoaded', function() {
         // Gestion de l'affichage du formulaire
         $(document).on('click', '.clickable-add-activity', function() {
             const $container = $(this).closest('.add-activity-container');
             $container.find('.activity-form').collapse('toggle');
         });

         // Supprimer tout événement existant avant d'ajouter le nouvel événement
         $(document).off('submit', '.create-activity-form').on('submit', '.create-activity-form', function(e) {
             e.preventDefault();
             const $form = $(this);
             const $submitBtn = $form.find('button[type="submit"]');

             $submitBtn.prop('disabled', true).html('<i class="bi bi-arrow-repeat animate-spin"></i>');

             $.ajax({
                 url: '/activites',
                 method: 'POST',
                 data: $form.serialize(),
                 success: (response) => {
                     const activity = response.activity;

                     const newActivity = `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1">
                        <strong>${activity.nom_activite}</strong>
                        <br>
                        <small>
                            📅 ${activity.date_debut_formatted} →
                            ${activity.date_prevue_formatted}
                            | Fin : ${activity.date_fin_formatted || 'Non définie'}
                        </small>
                        <small>
                            📅 ${activity.date_debut_formatted} → ${activity.date_prevue_formatted}
                            | Fin : ${activity.date_fin_formatted || 'Non définie'}
                            <br>
                            📍 ${activity.lieu_reunion || 'Non défini'} à ${activity.heure_reunion || '--:--'}
                            <br>
                            📝 ${activity.description_reunion || 'Aucune description'}
                        </small>

                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge mr-2" style="color: white; background-color: ${activity.color}">
                            ${activity.statut_activite}
                        </span>
                        <button class="btn btn-sm btn-outline-primary mr-2 edit-activity"
                                data-toggle="modal"
                                data-target="#editActivityModal"
                                data-id="${activity.id}"
                                data-nom="${activity.nom_activite}"
                                data-debut="${activity.raw_dates.debut}"
                                data-prevue="${activity.raw_dates.prevue}"
                                data-fin="${activity.raw_dates.fin || ''}"
                                data-lieu="${activity.lieu_reunion || ''}"
                                data-heure="${activity.heure_reunion || ''}"
                                data-description="${activity.description_reunion || ''}"
                                data-statut="${activity.statut_activite}">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </li>`;

                     // Insertion avant le formulaire
                     $form.closest('.add-activity-container').before(newActivity);
                     $form[0].reset();
                     $form.closest('.activity-form').collapse('hide');
                 },
                 error: (xhr) => {
                     alert('Erreur : ' + (xhr.responseJSON?.message ||
                         'Une erreur est survenue'));
                 },
                 complete: () => {
                     $submitBtn.prop('disabled', false).html('<i class="bi bi-check"></i>');
                 }
             });
         });
     });
 </script>
