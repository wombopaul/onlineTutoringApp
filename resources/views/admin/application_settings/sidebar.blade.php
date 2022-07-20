<div class="email__sidebar bg-style">
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{__('app.global_settings')}}</h2>

            <li>
                <a href="{{ route('settings.general_setting') }}" class="list-item {{ @$generalSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{__('app.global_settings')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.zoom-settings') }}" class="list-item {{ @$zoomSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{__('app.zoom_meeting_settings')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.social-login-settings') }}" class="list-item {{ @$socialLoginSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{__('app.social_login_settings')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.cookie-settings') }}" class="list-item {{ @$cookieSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{__('app.cookie_settings')}}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.aws-settings') }}" class="list-item {{ @$awsSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{__('app.aws_settings')}}</span>
                </a>
            </li>


            <li>
                <a href="{{ route('settings.vimeo-settings') }}" class="list-item {{ @$vimeoSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Vimeo Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.currency.index') }}" class="list-item {{ @$subNavCurrencyActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Currency Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.meta.index') }}" class="list-item {{ @$metaIndexActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Meta Management</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{__('app.location_settings')}}</h2>

            <li>
                <a href="{{ route('settings.location.country.index') }}" class="list-item {{ @$subNavCountryActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Country</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.location.state.index') }}" class="list-item {{ @$subNavStateActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>State</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.location.city.index') }}" class="list-item {{ @$subNavCityActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>City</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{__('app.home_settings')}}</h2>

            <li>
                <a href="{{ route('settings.banner-section') }}" class="list-item {{ @$bannerSectionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Banner Section</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.special-feature-section') }}" class="list-item {{ @$specialSectionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Special Feature Section</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.course-section') }}" class="list-item {{ @$courseSectionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Course Section</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.top-category-section') }}" class="list-item {{ @$topCategorySectionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Top Category Section</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.top-instructor-section') }}" class="list-item {{ @$topInstructorSectionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Top Instructor Section</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.become-instructor-video-section') }}" class="list-item {{ @$becomeInstructorVideoSectionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Become Instructor Video Section</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.customer-say-section') }}" class="list-item {{ @$customerSaySectionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Customer Say Section</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.achievement-section') }}" class="list-item {{ @$achievementSectionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Achievement Section</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>Mail Configuration</h2>

            <li>
                <a href="{{ route('settings.mail-configuration') }}" class="list-item {{ @$mailConfigSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Mail Configuration</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>Payment Options</h2>

            <li>
                <a href="{{ route('settings.payment_method_settings') }}" class="list-item {{ @$paymentMethodSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Payment Method</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>Become an Instructor</h2>

            <li>
                <a href="{{ route('settings.instructor-feature') }}" class="list-item {{ @$instructorFeatureSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Instructor Feature</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.instructor-procedure') }}" class="list-item {{ @$instructorProcedureSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Instructor Procedure</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.instructor.cms') }}" class="list-item {{ @$instructorCMSSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Instructor CMS</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>FAQ</h2>

            <li>
                <a href="{{ route('settings.faq.cms') }}" class="list-item {{ @$faqCMSSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>FAQ CMS</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.faq.tab') }}" class="list-item {{ @$faqCMSTabActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>FAQ Tab</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.faq.question') }}" class="list-item {{ @$faqQuestionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Question & Answer</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>Support Ticket</h2>

            <li>
                <a href="{{ route('settings.support-ticket.cms') }}" class="list-item {{ @$supportCMSSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Support Ticket CMS</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.support-ticket.question') }}" class="list-item {{ @$supportQuestionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Question & Answer</span>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.support-ticket.department') }}" class="list-item {{ @$supportDepartmentActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Support Ticket Department Field</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.support-ticket.priority') }}" class="list-item {{ @$supportPriorityActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Support Ticket Priority Field</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.support-ticket.services') }}" class="list-item {{ @$supportRelatedActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Support Ticket Related Service</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>About Us</h2>

            <li>
                <a href="{{ route('settings.about.gallery-area') }}" class="list-item {{ @$subNavGalleryAreaActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Gallery Area</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.about.our-history') }}" class="list-item {{ @$subNavOurHistoryActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Our History</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.about.upgrade-skill') }}" class="list-item {{ @$subNavUpgradeSkillActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Upgrade Skills</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.about.team-member') }}" class="list-item {{ @$subNavTeamMemberActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Team Member</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.about.instructor-support') }}" class="list-item {{ @$subNavInstructorSupportActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Instructor Support</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.about.client') }}" class="list-item {{ @$subNavClientActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Client</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>Contact Us</h2>

            <li>
                <a href="{{ route('settings.contact.cms') }}" class="list-item {{ @$contactUsSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>Contact Us</span>
                </a>
            </li>

        </ul>
    </div>
</div>
