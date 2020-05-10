import { Component, OnInit, AfterViewInit, ViewChild, ElementRef, OnDestroy } from '@angular/core';
import { DOMService } from 'src/app/core/services/dom.service';
import { UserService } from 'src/app/core/services/user.service';
import { CategoryService } from 'src/app/core/services/category.service';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { Router, NavigationEnd } from '@angular/router';
import { CartService } from 'src/app/core/services/cart.service';
import { faSearch } from '@fortawesome/free-solid-svg-icons';


@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit, AfterViewInit, OnDestroy {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  @ViewChild("nav", { static: false }) nav: ElementRef<HTMLElement>;
  @ViewChild("navTop", { static: false }) navTop: ElementRef<HTMLElement>;
  @ViewChild("hamburger", { static: false }) hamburger: ElementRef<HTMLElement>;
  @ViewChild("cartBtn", { static: false }) cartBtn: ElementRef<HTMLElement>;
  
  //Icon 
  faSearch = faSearch;
  
  isNavOpen = false;
  isAuthenticated = false;
  categories = [];

  cartItemsNumber = 0;

  constructor(
    private domService: DOMService,
    private userService: UserService,
    private categoryService: CategoryService,
    private router: Router,
    private cartService: CartService
  ) {

    // To prevent loss of context in event Listener
    this.onScroll = this.onScroll.bind(this);
  }

  ngOnInit() {
    this.isAuthenticated = this.userService.isAuthenticated();

    this.userService.authChange.pipe(takeUntil(this.destroy)).subscribe(() => {
      this.isAuthenticated = this.userService.isAuthenticated();
    })

    this.categoryService.getAllCategories().pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.categories = res.categories;
      },
    );



    //Mobile - Close nav on navigation 
    if (window.matchMedia("screen and (max-width: 992px)").matches) {
      this.router.events.subscribe((res) => {
        if (res instanceof NavigationEnd) {
          this.nav.nativeElement.classList.remove("is-mobile-active");
          this.hamburger.nativeElement.classList.remove("is-active");
          this.domService.unlockScroll();
        }
      });
    }


    //Cart logic
    this.cartService.cartChanged.pipe(takeUntil(this.destroy)).subscribe(res => {
      this.cartItemsNumber = res;
      
      //Cart added css animation class
      if (this.cartBtn) {
        this.cartBtn.nativeElement.classList.add("pulse");
        setTimeout(() => {
          this.cartBtn.nativeElement.classList.remove("pulse");
        }, 300);
      }
    })
  }

  ngAfterViewInit(): void {
    window.addEventListener("scroll", this.onScroll, { passive: true });
  }


  onScroll() {
    this.nav.nativeElement.classList.toggle("is-fixed", window.scrollY > this.navTop.nativeElement.offsetHeight + 50);
  }

  onHamburgerClick($event) {
    this.nav.nativeElement.classList.toggle("is-mobile-active");
    $event.currentTarget.classList.toggle("is-active");
    this.isNavOpen = !this.isNavOpen;

    if (this.isNavOpen) {
      this.domService.lockScroll();
    } else {
      this.domService.unlockScroll();
    }
  }



  ngOnDestroy(): void {
    window.removeEventListener("scroll", this.onScroll);
    this.destroy.next();
    this.destroy.complete();
  }



}
