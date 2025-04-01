<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Emails des parties prenantes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="emailsTextarea" class="form-control" rows="8" readonly>{{ $emails }}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="copyEmails()">Copier</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function copyEmails() {
        var textarea = document.getElementById("emailsTextarea");
        textarea.select();
        textarea.setSelectionRange(0, 99999); // Pour les appareils mobiles
        document.execCommand("copy");
        alert("Emails copiés dans le presse-papier !");
    }
</script>
