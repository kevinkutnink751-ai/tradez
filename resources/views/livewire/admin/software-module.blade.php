<div>
    <div class="row">
        <div class="col-12">

            <h3 class="text-info">This section describes how you want to use tradez software.</h3>
            <form action="">
                <div class="row">
                    <div class="mt-4 col-md-6">

                        <h5 class="">Investment:</h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="investment"
                                    wire:click="updateModule('investment','true')"
                                    {{ $mod['investment'] == 'true' ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="investment"
                                    wire:click="updateModule('investment','false')"
                                    {{ $mod['investment'] == 'false' ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2 pr-3">
                            <small class="">All features relating to user investment will be
                                displayed on user dashboard(buying of plan and earning profit etc..).</small>
                        </div>
                    </div>

                    <div class="mt-4 col-md-6">
                        <h5 class="">Crypto Swap:</h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="cryptoswap"
                                    wire:click="updateModule('cryptoswap','true')"
                                    {{ $mod['cryptoswap'] ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="cryptoswap"
                                    wire:click="updateModule('cryptoswap','false')"
                                    {{ $mod['cryptoswap'] ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2">
                            <small class="">If enabled, the system will display all
                                functionalities about crypto swapping on user dashboard.</small>
                        </div>
                    </div>


                    <div class="mt-4 col-md-6">
                        <h5 class="">CopyTrade: <span class="badge badge-info">Pro</span> </h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="subscription"
                                    wire:click="updateModule('subscription','true')"
                                    {{ $mod['subscription'] ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="subscription"
                                    wire:click="updateModule('subscription','false')"
                                    {{ $mod['subscription'] ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2">
                            <small class="">If enabled, the system will display all
                                functionalities relating to mt4 trading subscription on user dashboard.</small>
                        </div>
                    </div>


                    <div class="mt-4 col-md-6">
                        <h5 class="">Membership: <span class="badge badge-info">Pro</span></h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="membership"
                                    wire:click="updateModule('membership','true')"
                                    {{ $mod['membership'] ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="membership"
                                    wire:click="updateModule('membership','false')"
                                    {{ $mod['membership'] ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2">
                            <small class="">If enabled, the system will display all
                                functionalities about Membership on user dashboard.</small>
                        </div>
                    </div>

                    {{-- Signal Providing module --}}
                    <div class="mt-4 col-md-6">
                        <h5 class="">Signal Provider: <span class="badge badge-info">Pro</span></h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="signal"
                                    wire:click="updateModule('signal','true')" {{ $mod['signal'] ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="signal"
                                    wire:click="updateModule('signal','false')" {{ $mod['signal'] ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2">
                            <small class="">If enabled, the system will display all
                                functionalities about signal providing on user dashboard.</small>
                        </div>
                    </div>

                    <div class="mt-4 col-md-6">
                        <h5 class="">Spot Trading:</h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="spot"
                                    wire:click="updateModule('spot','true')" {{ isset($mod['spot']) && $mod['spot'] ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="spot"
                                    wire:click="updateModule('spot','false')" {{ isset($mod['spot']) && $mod['spot'] ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2">
                            <small class="">Enable/Disable Spot Trading terminal for users.</small>
                        </div>
                    </div>

                    <div class="mt-4 col-md-6">
                        <h5 class="">Future Trading:</h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="future"
                                    wire:click="updateModule('future','true')" {{ isset($mod['future']) && $mod['future'] ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="future"
                                    wire:click="updateModule('future','false')" {{ isset($mod['future']) && $mod['future'] ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2">
                            <small class="">Enable/Disable Future Trading terminal for users.</small>
                        </div>
                    </div>

                    <div class="mt-4 col-md-6">
                        <h5 class="">Binary Trading:</h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="binary"
                                    wire:click="updateModule('binary','true')" {{ isset($mod['binary']) && $mod['binary'] ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="binary"
                                    wire:click="updateModule('binary','false')" {{ isset($mod['binary']) && $mod['binary'] ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2">
                            <small class="">Enable/Disable Binary Trading terminal for users.</small>
                        </div>
                    </div>

                    <div class="mt-4 col-md-6">
                        <h5 class="">Options Trading:</h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="options"
                                    wire:click="updateModule('options','true')" {{ isset($mod['options']) && $mod['options'] ? 'checked' : '' }}>
                                <span class="selectgroup-button">Enabled</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" class="selectgroup-input" name="options"
                                    wire:click="updateModule('options','false')" {{ isset($mod['options']) && $mod['options'] ? '' : 'checked' }}>
                                <span class="selectgroup-button">Disabled</span>
                            </label>
                        </div>
                        <div class="mt-2">
                            <small class="">Enable/Disable Options Trading terminal for users.</small>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
