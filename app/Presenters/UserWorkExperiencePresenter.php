<?php

use Laracasts\Presenter\Presenter;

class UserWorkExperiencePresenter extends Presenter
{
    public function showRoute()
    {
        return route('profile.work-experiences.show', $this->id);
    }
}
