<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="remove-ext">

                <div class="team-page mt-15" style="min-height: 600px;">
                    <div class="row">
                        @foreach($members as $member)
                        <div class="col-md-3 mb-15">
                            <div class="member">
                                <div class="team">
                                    <div class="team-img" >
                                        <img style="height: 200px;" src="{{"/images/".$member->profile_img?:'/img/gallery/avatar.png'}}" alt="">
                                    </div>
                                    <div class="member-detail width-100 pt-10 pb-10 pl-25 pr-25">
                                        <h3><a class="pointer" title="">{{ucwords($member->name)}}</a></h3>
                                        <span>{{ucwords($member->position_name)}}</span>
                                    </div>
                                </div>
                            </div><!-- MEMBER -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
