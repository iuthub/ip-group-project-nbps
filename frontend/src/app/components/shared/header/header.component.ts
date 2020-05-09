import { Component, OnInit, AfterViewInit, ViewChild, ElementRef, OnDestroy } from '@angular/core';
import { DOMService } from 'src/app/core/services/dom.service';
import { UserService } from 'src/app/core/services/user.service';
import { CategoryService } from 'src/app/core/services/category.service';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';

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


  isNavOpen = false;
  isAuthenticated = false;
  categories = [];

  constructor(
    private domService: DOMService,
    private userService: UserService,
    private categoryService: CategoryService
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
