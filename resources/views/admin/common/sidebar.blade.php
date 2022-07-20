<div class="sidebar__area">
    <div class="sidebar__close">
        <button class="close-btn">
            <i class="fa fa-close"></i>
        </button>
    </div>

    <div class="sidebar__brand">
        <a href="{{ route('admin.dashboard') }}">
            @if(get_option('app_logo') != '')
                <img src="{{getImageFile(get_option('app_logo'))}}">
            @else
                <img src="">
            @endif
        </a>
    </div>

    <ul id="sidebar-menu" class="sidebar__menu">

        <li class=" {{ active_if_full_match('admin/dashboard') }} ">
            <a href="{{route('admin.dashboard')}}">
                <span class="iconify" data-icon="bxs:dashboard"></span>
                <span>{{__('app.dashboard')}}</span>
            </a>
        </li>
        @canany(['manage_course', 'pending_course', 'hold_course', 'approved_course', 'all_course'])
            <li>
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="dashicons:welcome-learn-more"></span>
                    <span>{{__('app.manage_course')}}</span>
                </a>
                <ul>
                    @can('pending_course')
                        <li class="{{ active_if_match('admin/course/review-pending') }}">
                            <a href="{{route('admin.course.review_pending')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.review_pending')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('hold_course')
                        <li class="{{ active_if_match('admin/course/hold') }}">
                            <a href="{{route('admin.course.hold')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.hold')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('approved_course')

                        <li class="{{ active_if_match('admin/course/approved') }}">
                            <a href="{{route('admin.course.approved')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.approved')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can('all_course')
                        <li class="{{ active_if_full_match('admin/course') }}">
                            <a href="{{route('admin.course.index')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.all_courses')}}</span>
                            </a>
                        </li>
                    @endcan

                    <li class="{{ active_if_full_match('admin/course/enroll') }}">
                        <a href="{{route('admin.course.enroll')}}">
                            <i class="fa fa-circle"></i>
                            <span>Enroll in Course</span>
                        </a>
                    </li>

                </ul>
            </li>
        @endcanany
        @canany(['manage_course_reference', 'manage_course_category', 'manage_course_subcategory', 'manage_course_tag', 'manage_course_language', 'manage_course_difficulty_level'])
            <li class="{{ @$navCourseActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="codicon:references"></span>
                    <span>{{__('app.course_reference')}}</span>
                </a>
                <ul>
                    @can('manage_course_category')
                        <li class="{{ active_if_match('admin/category') }}">
                            <a href="{{route('category.index')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.categories')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can('manage_course_subcategory')
                        <li class="{{ active_if_match('admin/subcategory') }}">
                            <a href="{{route('subcategory.index')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.subcategory')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('manage_course_tag')

                        <li class="{{ active_if_match('admin/tag') }}">
                            <a href="{{route('tag.index')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.tags')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can('manage_course_language')
                        <li class="{{ active_if_match('admin/course-language') }}">
                            <a href="{{route('course-language.index')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.languages')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can('manage_course_difficulty_level')

                        <li class="{{ active_if_match('admin/difficulty-level') }}">
                            <a href="{{route('difficulty-level.index')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.difficulty_levels')}}</span>
                            </a>
                        </li>

                    @endcan

                    <li class="{{ @$subNavSpecialPromotionIndexActiveClass }}">
                        <a href="{{route('special_promotional_tag.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>Promotional Tag</span>
                        </a>
                    </li>
                    <li class="{{ active_if_match('admin/course-upload-rules') }}">
                        <a href="{{route('course-rules.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>Rules & Benefits</span>
                        </a>
                    </li>

                </ul>
            </li>

        @endcanany
        @canany(['manage_instructor', 'pending_instructor', 'approved_instructor', 'all_instructor'])
            <li>
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="la:chalkboard-teacher"></span>
                    <span>{{__('app.manage_instructor')}}</span>
                </a>
                <ul>
                    @can('pending_instructor')
                        <li class="{{ active_if_match('admin/instructor/pending') }}">
                            <a href="{{route('instructor.pending')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.pending_instructor')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can('approved_instructor')
                        <li class="{{ active_if_match('admin/instructor/approved') }}">
                            <a href="{{route('instructor.approved')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.approved_instructors')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can('all_instructor')

                        <li class="
                        {{ active_if_full_match('admin/instructor') }}
                        {{ active_if_match('admin/instructor/view/*') }}
                    ">
                            <a href="{{route('instructor.index')}}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.all_instructors')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('add_instructor')
                    <li class="{{ active_if_match('admin/instructor/create') }}">
                        <a href="{{route('instructor.create')}}">
                            <i class="fa fa-circle"></i>
                            <span>Add Instructor</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @can('manage_student')
            <li class=" {{ active_if_full_match('admin/student') }} ">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="ph:student"></span>
                    <span>{{__('app.manage_student')}}</span>
                </a>
                <ul>
                    <li class="{{ active_if_match('admin/student') }}">
                        <a href="{{route('student.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>All Student</span>
                        </a>
                    </li>
                    <li class="{{ active_if_match('admin/student/create') }}">
                        <a href="{{route('student.create')}}">
                            <i class="fa fa-circle"></i>
                            <span>Add Student</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('manage_coupon')
            <li class="{{ @$navCouponActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="ri:coupon-3-fill"></span>
                    <span>{{__('app.manage_coupon')}}</span>
                </a>
                <ul>
                    <li class="{{ @$subNavCouponIndexActiveClass }}">
                        <a href="{{ route('coupon.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.coupon_list')}}</span>
                        </a>
                    </li>
                    <li class="{{ @$navCouponAddActiveClass }}">
                        <a href="{{ route('coupon.create') }}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.add_coupon')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('manage_promotion')
        <li class="{{ @$navPromotionParentActiveClass }}">
            <a class="has-arrow" href="#">
                <span class="iconify" data-icon="ic:round-discount"></span>
                <span>{{ __('app.manage_promotion') }}</span>
            </a>
            <ul>
                <li class="{{ @$subNavPromotionIndexActiveClass }}">
                    <a href="{{ route('promotion.index') }}">
                        <i class="fa fa-circle"></i>
                        <span>Promotion List</span>
                    </a>
                </li>
                <li class="{{@$subNavAddPromotionActiveClass}}">
                    <a href="{{ route('promotion.create') }}">
                        <i class="fa fa-circle"></i>
                        <span>Add Promotion</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('payout')
            <li class="{{ @$navFinanceParentActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="clarity:dollar-bill-solid"></span>
                    <span>{{__('app.manage_payout')}}</span>
                </a>
                <ul class="{{ @$navFinanceShowClass }}">
                    <li class="{{@$subNavFinanceNewWithdrawActiveClass}}">
                        <a href="{{route('payout.new-withdraw')}}">
                            <i class="fa fa-circle"></i>
                            <span> Request Withdrawal</span>
                        </a>
                    </li>

                    <li class="{{@$subNavFinanceCompleteWithdrawActiveClass}}">
                        <a href="{{route('payout.complete-withdraw')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.complete_withdrawal')}}</span>
                        </a>
                    </li>
                    <li class="{{@$subNavFinancerejectedWithdrawActiveClass}}">
                        <a href="{{route('payout.rejected-withdraw')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.rejected_withdrawal')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan


        @can('finance')
            <li class="">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="map:finance"></span>
                    <span>Financial Report</span>
                </a>
                <ul>
                    <li class="{{ active_if_full_match('admin/report/revenue-report') }}">
                        <a href="{{route('report.revenue-report')}}">
                            <i class="fa fa-circle"></i>
                            <span>Revenue Report</span>
                        </a>
                    </li>
                    <li class="{{ active_if_full_match('admin/report/order-report') }}">
                        <a href="{{route('report.order-report')}}">
                            <i class="fa fa-circle"></i>
                            <span>Order Report</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('manage_certificate')
            <li class="{{ @$navCertificateActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="fluent:certificate-20-filled"></span>
                    <span>{{__('app.certificate')}}</span>
                </a>
                <ul>
                    <li class="{{ @$subNavAllCertificateActiveClass }}">
                        <a href="{{route('certificate.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.all_certificates')}}</span>
                        </a>
                    </li>
                    <li class="{{ @$subNavAddCertificateActiveClass }}">
                        <a href="{{route('certificate.create')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.add_certificate')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('ranking_level')
            <li class="{{ @$navRankingActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="fa6-solid:ranking-star"></span>
                    <span>{{__('app.ranking_Level')}}</span>
                </a>
                <ul>
                    <li class="{{ @$subNavRankingActiveClass }}">
                        <a href="{{route('ranking.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.all_Level')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('manage_language')
            <li>
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="fa6-solid:language"></span>
                    <span>{{__('app.manage_language')}}</span>
                </a>
                <ul>
                    <li class="{{ active_if_match('admin/language') }}">
                        <a href="{{route('language.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.language_settings')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('support_ticket')
            <li class="{{ @$navSupportTicketParentActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="ic:twotone-support-agent"></span>
                    <span>{{__('app.support_ticket')}}</span>
                </a>
                <ul class="">
                    <li class="{{ @$subNavSupportTicketIndexActiveClass }}">
                        <a href="{{ route('support-ticket.admin.index') }}">
                            <i class="fa fa-circle"></i>
                            <span> {{__('app.all_tickets')}} </span>
                        </a>
                    </li>
                    <li class="{{ @$subNavSupportTicketOpenActiveClass }}">
                        <a href="{{ route('support-ticket.admin.open') }}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.open_ticket')}}</span>
                        </a>
                    </li>

                </ul>
            </li>
        @endcan

        @can('user_management')
            <li class="{{ @$navUserParentActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="bxs:user-account"></span>
                    <span>{{__('app.admin_management')}}</span>
                </a>
                <ul class="{{ @$navUserParentShowClass }}">
                    <li class="{{ @$subNavUserCreateActiveClass }}">
                        <a href="{{route('user.create')}}">
                            <i class="fa fa-circle"></i>
                            <span> {{__('app.add_user')}} </span>
                        </a>
                    </li>
                    <li class="{{ @$subNavUserActiveClass }}">
                        <a href="{{route('user.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.all_users')}}</span>
                        </a>
                    </li>
                    <li class="{{ @$subNavUserRoleActiveClass }}">
                        <a href="{{route('role.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.roles')}}</span>
                        </a>
                    </li>


                </ul>
            </li>
        @endcan

        @can('user_management')
            <li class="{{ @$navEmailActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="dashicons:email"></span>
                    <span>{{__('app.email_management')}}</span>
                </a>
                <ul class="{{ @$navEmailParentShowClass }}">


                    <li class="{{ @$subNavEmailTemplateActiveClass }}">
                        <a href="{{route('email-template.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.email_template')}}</span>
                        </a>
                    </li>

                    <li class="{{ @$subNavSendMailActiveClass }}">
                        <a href="{{route('email-template.send-email')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.send_email')}}</span>
                        </a>
                    </li>

                </ul>
            </li>
        @endcan


        <li class="{{ @$navPageParentActiveClass }}">
            <a class="has-arrow" href="#">
                <span class="iconify" data-icon="dashicons:edit-page"></span>
                <span>{{__('app.manage_page')}}</span>
            </a>
            <ul class="">
                <li class="{{ @$subNavPageAddActiveClass }}">
                    <a href="{{route('page.create')}}">
                        <i class="fa fa-circle"></i>
                        <span> {{__('app.add_page')}} </span>
                    </a>
                </li>
                <li class="{{ @$subNavPageIndexActiveClass }}">
                    <a href="{{route('page.index')}}">
                        <i class="fa fa-circle"></i>
                        <span>{{__('app.all_pages')}}</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="{{ @$navMenuParentActiveClass }}">
            <a class="has-arrow" href="#">
                <span class="iconify" data-icon="bi:menu-up"></span>
                <span>{{__('app.manage_menu')}}</span>
            </a>
            <ul class="">
                <li class="{{ @$subNavStaticMenuIndexActiveClass }}">
                    <a href="{{route('menu.static')}}">
                        <i class="fa fa-circle"></i>
                        <span>{{__('app.static_menu')}}</span>
                    </a>
                </li>
                <li class="{{ @$subNavDynamicMenuIndexActiveClass }}">
                    <a href="{{route('menu.dynamic')}}">
                        <i class="fa fa-circle"></i>
                        <span>{{__('app.dynamic_menu')}}</span>
                    </a>
                </li>

            </ul>
        </li>


        @canany(['application_setting', 'global_setting', 'home_setting', 'mail_configuration', 'payment_option', 'content_setting'])
            <li class="{{ @$navApplicationSettingParentActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="mdi:application-cog-outline"></span>
                    <span>{{__('app.application_settings')}}</span>
                </a>
                <ul class="">
                    @can('global_setting')
                        <li class="{{ @$subNavGlobalSettingsActiveClass }}">
                            <a href="{{ route('settings.general_setting') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.global_settings')}}</span>
                            </a>
                        </li>
                    @endcan


                    <li class="{{ @$subNavLocationSettingsActiveClass }}">
                        <a href="{{ route('settings.location.country.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.location_settings')}}</span>
                        </a>
                    </li>

                    @can('home_setting')
                        <li class="{{ @$subNavHomeSettingsActiveClass }}">
                            <a href="{{ route('settings.banner-section') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.home_settings')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can('mail_configuration')

                        <li class="{{ @$subNavMailConfigSettingsActiveClass }}">
                            <a href="{{ route('settings.mail-configuration') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.mail_configuration')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('payment_option')
                        <li class="{{ @$subNavPaymentOptionsSettingsActiveClass }}">
                            <a href="{{ route('settings.payment_method_settings') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.payment_options')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('content_setting')
                        <li class="{{ @$subNavInstructorSettingsActiveClass }}">
                            <a href="{{ route('settings.instructor-feature') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.become_instructor')}}</span>
                            </a>
                        </li>

                        <li class="{{ @$subNavFAQSettingsActiveClass }}">
                            <a href="{{ route('settings.faq.cms') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.faq')}}</span>
                            </a>
                        </li>
                        <li class="{{ @$subNavSupportSettingsActiveClass }}">
                            <a href="{{ route('settings.support-ticket.cms') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.support_ticket')}}</span>
                            </a>
                        </li>

                        <li class="{{ @$subNavAboutUsSettingsActiveClass }}">
                            <a href="{{ route('settings.about.gallery-area') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.about_us')}}</span>
                            </a>
                        </li>

                        <li class="{{ @$subNavContactUsSettingsActiveClass }}">
                            <a href="{{ route('settings.contact.cms') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('app.contact_us')}}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        <li class="{{ @$navPolicyActiveClass }}">
            <a class="has-arrow" href="#">
                <span class="iconify" data-icon="dashicons:privacy"></span>
                <span>{{__('app.policy_setting')}}</span>
            </a>
            <ul>
                <li class="{{ @$subNavPrivacyPolicyActiveClass }}">
                    <a href="{{ route('admin.privacy-policy') }}">
                        <i class="fa fa-circle"></i>
                        <span> {{__('app.privacy_policy')}} </span>
                    </a>
                </li>
                <li class="{{ @$subNavCookiePolicyActiveClass }}">
                    <a href="{{ route('admin.cookie-policy') }}">
                        <i class="fa fa-circle"></i>
                        <span> {{__('app.cookie_policy')}} </span>
                    </a>
                </li>
            </ul>
        </li>

        @can('content_setting')
            <li class="{{ @$navContactUsParentActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="fluent:contact-card-32-regular"></span>
                    <span>{{__('app.contact_us')}}</span>
                </a>
                <ul class="{{ @$navContactUsParentShowClass }}">
                    <li class="{{ @$subNavContactUsIndexActiveClass }}">
                        <a href="{{ route('contact.index') }}">
                            <i class="fa fa-circle"></i>
                            <span> {{__('app.all_contact_us')}} </span>
                        </a>
                    </li>
                    <li class="{{ @$subNavContactUsIssueIndexActiveClass }}">
                        <a href="{{ route('contact.issue.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.all_contact_us_issue')}}</span>
                        </a>
                    </li>
                    <li class="{{ @$subNavContactUsIssueAddActiveClass }}">
                        <a href="{{ route('contact.issue.create') }}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.add_contact_us_issue')}}</span>
                        </a>
                    </li>

                </ul>
            </li>
        @endcan

        @can('manage_blog')
            <li class="{{ @$navBlogParentActiveClass }}">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="dashicons:welcome-write-blog"></span>
                    <span>{{__('app.manage_blog')}} </span>
                </a>
                <ul>
                    <li class="{{ active_if_full_match('admin/blog/create') }}">
                        <a href="{{route('blog.create')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.add_blog')}}</span>
                        </a>
                    </li>
                    <li class="{{ active_if_full_match('admin/blog') }} {{ active_if_full_match('admin/blog/edit/*') }}">
                        <a href="{{route('blog.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.all_blog')}}</span>
                        </a>
                    </li>
                    <li class="{{ @$subNavBlogCommentListActiveClass }}">
                        <a href="{{route('blog.blog-comment-list')}}">
                            <i class="fa fa-circle"></i>
                            <span>Blog Comment List</span>
                        </a>
                    </li>
                    <li class="{{ @$subNavBlogCategoryIndexActiveClass }}">
                        <a href="{{route('blog.blog-category.index')}}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.blog_category')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('account_setting')
            <li class="mb-5">
                <a class="has-arrow" href="#">
                    <span class="iconify" data-icon="bytesize:settings"></span>
                    <span>{{__('app.account_settings')}}</span>
                </a>
                <ul class="{{ @$navUserParentShowClass }}">
                    <li class="{{ active_if_full_match('admin/profile') }}">
                        <a href="{{route('admin.profile')}}">
                            <i class="fa fa-circle"></i>
                            <span> {{__('app.profile')}} </span>
                        </a>
                    </li>
                    <li class="{{ active_if_full_match('admin/profile/change-password') }}">
                        <a href="{{ route('admin.change-password') }}">
                            <i class="fa fa-circle"></i>
                            <span>{{__('app.change_password')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

    </ul>
</div>
