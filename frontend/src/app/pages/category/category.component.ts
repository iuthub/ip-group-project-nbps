import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';
import { CategoryService } from 'src/app/core/services/category.service';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { Item } from 'src/app/core/models/item.model';

@Component({
  selector: 'app-category',
  templateUrl: './category.component.html',
  styleUrls: ['./category.component.scss']
})
export class CategoryComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  items : Item[] = [];

  isLoading = true;

  constructor(private route: ActivatedRoute, private categoryService: CategoryService) { }
  ngOnInit(): void {
    this.route.params.subscribe((params: Params) => {
      this.isLoading = true;
      this.categoryService.getItemsByCategoryId(params.id).pipe(takeUntil(this.destroy)).subscribe(
        (res) => {
          this.items = res.items;
          this.isLoading = false;
        },
      );
    });

  }



}
