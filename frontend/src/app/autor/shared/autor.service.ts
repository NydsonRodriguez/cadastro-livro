import { Injectable } from "@angular/core";
import { Observable } from "rxjs";
import { WebApiService } from '../../service/web-api.service';
import { environment } from '../../../environments/environment';

var apiUrl = environment.endpointApi;

var httpLink = {
  create: apiUrl + "autor/create",
  read: apiUrl + "autor/read",
  edit: apiUrl + "autor/edit",
  update: apiUrl + "autor/update",
  delete: apiUrl + "autor/delete",
};

@Injectable({
  providedIn: "root",
})
export class AutorService {
  constructor(private webApiService: WebApiService) {}

  public create(model: any): Observable<any> {
    return this.webApiService.post(httpLink.create, model);
  }

  public read(): Observable<any> {
    return this.webApiService.get(httpLink.read);
  }

  public edit(id: number): Observable<any> {
    return this.webApiService.get(httpLink.edit + '/' + id);
  }

  public update(model: any, id: number): Observable<any> {
    return this.webApiService.put(httpLink.update + '/' + id, model);
  }

  public delete(id: any): Observable<any> {
    return this.webApiService.delete(httpLink.delete + '/' + id);
  }
}
