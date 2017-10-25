<div class="tab-pane" id="ledger" role="tabpanel" aria-expanded="false">
    <div class="row tables-page">
        <div class="col">
            @include('trips.ledgers.partials._index',[
    			'showForm' => true,
    			'showOrder' => false,
        	])
        </div>
    </div>
</div>
