<div>
    <section class="p-2">
        <div class="row">
            <div class="col-md-12 shadow-lg p-4">
                <div class="card-body">
                    {{-- message here --}}
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    {{-- it ends here --}}
                    <div class="card-header">
                        <h2>Back-up</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-2">
                            <h4>Database Backup in Progress</h4>
                            <p>Please wait while we securely back up your data. This may take a few moments.</p>
                            <p>Here's a quick guide to backing up your data:</p>
                            <ul>
                              <li>Choose a reliable backup method, like an external hard drive, cloud storage, or network-attached storage.</li>
                              <li>Schedule regular backups to ensure your data is protected continuously.</li>
                              <li>Encrypt sensitive data to keep it confidential.</li>
                              <li>Test your backups regularly to make sure they're working correctly.</li>
                              <li>Store backups securely in a separate location from your device.</li>
                            </ul>
                          </div>

                        <div class="d-flex align-items-center justify-content-center m-2">
                            <button wire:click="backupDatabase" wire:loading.attr='disabled'
                                class="btn btn-md bg-warning">Back-up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
