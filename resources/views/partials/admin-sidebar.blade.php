<div id="kt_docs_aside" class="docs-aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_docs_aside_toggle">
          <!--begin::Logo-->
          <div class="docs-aside-logo flex-column-auto h-75px" id="kt_docs_aside_logo">
            <!--begin::Link-->
            <a href="#">
              <img alt="Logo" src="/assets/img/logo/logo-blue.png" class="h-30px" />
            </a>
            <!--end::Link-->
          </div>
          <!--end::Logo-->
          <!--begin::Menu-->
          <div class="docs-aside-menu flex-column-fluid">
            <!--begin::Aside Menu-->
            <div class="hover-scroll-overlay-y mt-5 mb-5 mt-lg-0 mb-lg-5 pe-lg-n2 me-lg-2" id="kt_docs_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_docs_aside_logo" data-kt-scroll-wrappers="#kt_docs_aside_menu" data-kt-scroll-offset="10px">
              <!--begin::Menu-->
              <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_docs_aside_menu" data-kt-menu="true">
                
                <div class="menu-item">
                  <h4 class="menu-content text-muted mb-0 fs-7 text-uppercase">Menu</h4>
                </div>
                <div class="menu-item">
                  <a class="menu-link py-2" href="/dashboard">
                    <span class="menu-title">Dashboard</span>
                  </a>
                </div>
                <div class="menu-item">
                  <a class="menu-link py-2" href="/dashboard/career">
                    <span class="menu-title">Data Karir</span>
                  </a>
                </div>
                <div class="menu-item">
                  <a class="menu-link py-2" href="/dashboard/certification">
                    <span class="menu-title">Data Sertifikasi</span>
                  </a>
                </div>
                <div class="menu-item">
                  <a class="menu-link py-2" href="/dashboard/cooperation">
                    <span class="menu-title">Data Kerjasama</span>
                  </a>
                </div>
                <div class="menu-item">
                  <a class="menu-link py-2" href="/dashboard/transaction">
                    <span class="menu-title">Data Koperasi</span>
                  </a>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                  <span class="menu-link py-2">
                    <span class="menu-title">E-Commerce</span>
                    <span class="menu-arrow"></span>
                  </span>
                  <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                      <a class="menu-link py-2" href="/dashboard/category">
                        <span class="menu-bullet">
                          <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Kategori</span>
                      </a>
                    </div>
                    <div class="menu-item">
                      <a class="menu-link py-2" href="/dashboard/product">
                        <span class="menu-bullet">
                          <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Produk</span>
                      </a>
                    </div>
                  </div>
                </div>

                @if(in_array("6", $previlege))
                <div class="menu-item">
                  <a class="menu-link py-2" href="/dashboard/user">
                    <span class="menu-title">Pengaturan User</span>
                  </a>
                </div>
                @endif
                
                <div class="menu-item">
                  <div class="h-30px"></div>
                </div>

              </div>
              <!--end::Menu-->
            </div>
          </div>
          <!--end::Menu-->
        </div>