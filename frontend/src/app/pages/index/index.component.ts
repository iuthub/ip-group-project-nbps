import { Component, OnInit } from '@angular/core';
import { Item } from 'src/app/core/models/item.model';
import { Subject } from 'rxjs';
import { ActivatedRoute, Params } from '@angular/router';
import { CategoryService } from 'src/app/core/services/category.service';
import { takeUntil } from 'rxjs/operators';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.scss']
})
export class IndexComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  items: Item[] = [];

  isLoading = true;

  constructor(private route: ActivatedRoute, private categoryService: CategoryService) { }

  ngOnInit() {
    this.isLoading = true;
    this.categoryService.getItemsByCategoryId(1).pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.items = res.items;
        this.isLoading = false;
      },
    );
  }

}
